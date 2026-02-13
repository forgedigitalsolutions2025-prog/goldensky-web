<?php

namespace App\Http\Controllers;

use App\Services\HotelApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    /** Admin password - set ADMIN_PASSWORD in .env for production; fallback for local only */
    private const ADMIN_PASSWORD_DEFAULT = 'admin@goldensky2024';
    
    private $apiService;

    public function __construct(HotelApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Show admin login
     */
    public function showLogin()
    {
        // Check if already authenticated
        if (session('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $adminPassword = env('ADMIN_PASSWORD');
        $passwordToCheck = ($adminPassword !== null && $adminPassword !== '') ? $adminPassword : self::ADMIN_PASSWORD_DEFAULT;
        if (app()->environment('production') && ($adminPassword === null || $adminPassword === '' || $adminPassword === self::ADMIN_PASSWORD_DEFAULT)) {
            Log::error('Admin login attempted but ADMIN_PASSWORD is not set or is default in production.');
            return redirect()->back()
                ->withErrors(['password' => 'Admin access is not configured. Set a strong ADMIN_PASSWORD in .env.'])
                ->withInput();
        }
        if ($request->password === $passwordToCheck) {
            session(['admin_authenticated' => true]);
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()
            ->withErrors(['password' => 'Incorrect password'])
            ->withInput();
    }

    /**
     * Handle admin logout
     */
    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect()->route('home');
    }

    /**
     * Show admin dashboard with business analytics
     */
    public function dashboard(Request $request)
    {
        // Check authentication
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $period = $request->input('period', 'month');
        $startDate = $this->getStartDate($period);
        $endDate = now();

        // Get business metrics (gracefully handle DB unavailable / timeout)
        try {
            $metrics = $this->calculateMetrics($startDate, $endDate);
            $charts = $this->prepareChartData($startDate, $endDate, $period);
        } catch (QueryException $e) {
            Log::warning('Admin dashboard: database unavailable or timeout', ['error' => $e->getMessage()]);
            // Still fetch booking/room/guest metrics from API so dashboard is useful
            $metrics = $this->getMetricsFromApiOnly($startDate, $endDate);
            $charts = ['revenue' => []];
        }

        $recentBookings = $this->getRecentBookings(10);

        // Get expenses from backend API
        $expenses = $this->getExpenses($startDate, $endDate);
        $metrics['total_expenses'] = $expenses['total'];
        $metrics['net_profit'] = $metrics['room_revenue'] - $expenses['total'];
        $metrics['expenses_breakdown'] = $expenses['breakdown'];

        return view('admin.dashboard', compact('metrics', 'charts', 'recentBookings', 'period'));
    }

    /**
     * Get only API-based metrics (no DB). Used when database is unavailable so dashboard still shows bookings/rooms/guests.
     */
    private function getMetricsFromApiOnly($startDate, $endDate)
    {
        $totalBookings = 0;
        $occupancyRate = 0;
        $totalRooms = 0;
        $activeBookings = 0;
        $pendingBookings = 0;
        $completedBookings = 0;
        $availableRooms = 0;
        $totalGuests = 0;

        try {
            $allBookings = collect($this->apiService->getAllBookings());
            $totalBookings = $allBookings->filter(function ($booking) use ($startDate, $endDate) {
                $bookedDate = isset($booking['bookedDate']) ? Carbon::parse($booking['bookedDate']) : null;
                return $bookedDate &&
                       $bookedDate->between($startDate, $endDate) &&
                       ($booking['status'] ?? '') !== 'CANCELLED';
            })->count();
        } catch (\Exception $e) {
            Log::warning('getMetricsFromApiOnly: bookings', ['error' => $e->getMessage()]);
        }

        try {
            $allRooms = $this->apiService->getAllRooms();
            $totalRooms = is_array($allRooms) ? count($allRooms) : 0;
            $totalDays = max(1, $startDate->diffInDays($endDate) + 1);
            $totalRoomNights = $totalRooms * $totalDays;
            $allBookings = collect($this->apiService->getAllBookings());
            $bookedNights = $allBookings->filter(function ($booking) use ($startDate, $endDate) {
                $checkIn = isset($booking['checkInTime']) ? Carbon::parse($booking['checkInTime']) : null;
                return $checkIn &&
                       $checkIn->between($startDate, $endDate) &&
                       ($booking['status'] ?? '') !== 'CANCELLED';
            })->sum(function ($booking) {
                return $booking['numberOfNights'] ?? 0;
            });
            $occupancyRate = $totalRoomNights > 0 ? ($bookedNights / $totalRoomNights) * 100 : 0;
        } catch (\Exception $e) {
            Log::warning('getMetricsFromApiOnly: occupancy', ['error' => $e->getMessage()]);
        }

        try {
            $activeBookings = count($this->apiService->getBookingsByStatus('CHECKED_IN'));
            $pendingBookings = count($this->apiService->getBookingsByStatus('PENDING'));
            $allBookings = collect($this->apiService->getAllBookings());
            $completedBookings = $allBookings->filter(function ($booking) use ($startDate, $endDate) {
                $checkOut = isset($booking['checkOutTime']) ? Carbon::parse($booking['checkOutTime']) : null;
                return ($booking['status'] ?? '') === 'CHECKED_OUT' &&
                       $checkOut && $checkOut->between($startDate, $endDate);
            })->count();
        } catch (\Exception $e) {
            Log::warning('getMetricsFromApiOnly: statuses', ['error' => $e->getMessage()]);
        }

        try {
            $availableRooms = count($this->apiService->getRoomsByStatus('AVAILABLE'));
        } catch (\Exception $e) {
            Log::warning('getMetricsFromApiOnly: available rooms', ['error' => $e->getMessage()]);
        }

        try {
            $allGuests = collect($this->apiService->getAllGuests());
            $totalGuests = $allGuests->filter(function ($guest) use ($startDate, $endDate) {
                $createdAt = isset($guest['createdAt']) ? Carbon::parse($guest['createdAt']) : null;
                return $createdAt && $createdAt->between($startDate, $endDate);
            })->count();
        } catch (\Exception $e) {
            Log::warning('getMetricsFromApiOnly: guests', ['error' => $e->getMessage()]);
        }

        $roomRevenue = $this->getRevenueFromApi($startDate, $endDate);

        return [
            'room_revenue' => $roomRevenue,
            'total_bookings' => $totalBookings,
            'occupancy_rate' => round($occupancyRate, 1),
            'active_bookings' => $activeBookings,
            'pending_bookings' => $pendingBookings,
            'completed_bookings' => $completedBookings,
            'available_rooms' => $availableRooms,
            'total_guests' => $totalGuests,
            'total_rooms' => $totalRooms,
        ];
    }

    /**
     * Calculate business metrics
     */
    private function calculateMetrics($startDate, $endDate)
    {
        // Total Revenue from ACTUAL PAYMENTS (not bookings)
        // Revenue is recognized when payment is received, not when booking is made
        $roomRevenue = DB::table('payments')
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->where('currency', 'LKR')
            ->where('payment_type', '!=', 'REFUND') // Exclude refunds
            ->sum('amount') ?? 0;
        
        // Add restaurant orders without payment records (table orders paid at restaurant)
        // This matches the Night Audit logic to ensure consistency
        $restaurantRevenueFromOrders = 0;
        try {
            // Get all payments with restaurant order IDs to identify which orders have payments
            $ordersWithPayments = DB::table('payments')
                ->whereBetween('payment_date', [$startDate, $endDate])
                ->whereNotNull('restaurant_order_id')
                ->where('restaurant_order_id', '!=', '')
                ->pluck('restaurant_order_id')
                ->toArray();
            
            // Get restaurant orders for the date range
            $restaurantOrders = DB::table('orders')
                ->whereBetween('order_date', [$startDate, $endDate])
                ->where(function($query) {
                    // Restaurant orders have tableNumber OR orderType is RESTAURANT
                    $query->whereNotNull('table_number')
                          ->where('table_number', '!=', '')
                          ->orWhere('order_type', 'RESTAURANT');
                })
                ->where(function($query) {
                    // Exclude room service (has roomNumber and no tableNumber)
                    $query->whereNull('room_number')
                          ->orWhere('room_number', '')
                          ->orWhereNotNull('table_number');
                })
                ->get();
            
            foreach ($restaurantOrders as $order) {
                // Check if order is completed (same logic as Night Audit)
                $isCompleted = false;
                
                if (!empty($order->invoice_number)) {
                    $isCompleted = true;
                } else if (!empty($order->status)) {
                    $isCompleted = !in_array($order->status, ['PENDING', 'PREPARING', 'READY', 'CANCELLED']);
                }
                
                if (!$isCompleted) {
                    continue;
                }
                
                // Check if order has a payment record
                $hasPaymentRecord = in_array($order->order_id, $ordersWithPayments);
                
                // Only include orders without payment records (table orders paid at restaurant)
                if (!$hasPaymentRecord && $order->total) {
                    $restaurantRevenueFromOrders += (float) $order->total;
                }
            }
        } catch (\Exception $e) {
            // Silently fail - restaurant orders are optional for revenue calculation
            \Log::warning('Could not fetch restaurant orders for revenue calculation: ' . $e->getMessage());
        }
        
        // Total revenue = payments + restaurant orders without payments
        $roomRevenue += $restaurantRevenueFromOrders;

        // Total bookings (for reference) - using API
        try {
            $allBookings = collect($this->apiService->getAllBookings());
            $totalBookings = $allBookings->filter(function ($booking) use ($startDate, $endDate) {
                $bookedDate = isset($booking['bookedDate']) ? Carbon::parse($booking['bookedDate']) : null;
                return $bookedDate && 
                       $bookedDate->between($startDate, $endDate) &&
                       ($booking['status'] ?? '') !== 'CANCELLED';
            })->count();
        } catch (\Exception $e) {
            Log::error('Error fetching bookings for metrics', ['error' => $e->getMessage()]);
            $totalBookings = 0;
        }

        // Occupancy rate - using API
        try {
            $allRooms = $this->apiService->getAllRooms();
            $totalRooms = count($allRooms);
            
        // Add 1 to make the date range inclusive (e.g., Dec 1 to Dec 3 = 3 days, not 2)
        $totalDays = max(1, $startDate->diffInDays($endDate) + 1);
        $totalRoomNights = $totalRooms * $totalDays;
        
            $allBookings = collect($this->apiService->getAllBookings());
            $bookedNights = $allBookings->filter(function ($booking) use ($startDate, $endDate) {
                $checkIn = isset($booking['checkInTime']) ? Carbon::parse($booking['checkInTime']) : null;
                return $checkIn && 
                       $checkIn->between($startDate, $endDate) &&
                       ($booking['status'] ?? '') !== 'CANCELLED';
            })->sum(function ($booking) {
                return $booking['numberOfNights'] ?? 0;
            });
        
        $occupancyRate = $totalRoomNights > 0 ? ($bookedNights / $totalRoomNights) * 100 : 0;
        } catch (\Exception $e) {
            Log::error('Error calculating occupancy rate', ['error' => $e->getMessage()]);
            $totalRooms = 0;
            $occupancyRate = 0;
        }

        // Active bookings - using API
        try {
            $activeBookings = count($this->apiService->getBookingsByStatus('CHECKED_IN'));
            $pendingBookings = count($this->apiService->getBookingsByStatus('PENDING'));
            
            $allBookings = collect($this->apiService->getAllBookings());
            $completedBookings = $allBookings->filter(function ($booking) use ($startDate, $endDate) {
                $checkOut = isset($booking['checkOutTime']) ? Carbon::parse($booking['checkOutTime']) : null;
                return ($booking['status'] ?? '') === 'CHECKED_OUT' &&
                       $checkOut && $checkOut->between($startDate, $endDate);
            })->count();
        } catch (\Exception $e) {
            Log::error('Error fetching booking statuses', ['error' => $e->getMessage()]);
            $activeBookings = 0;
            $pendingBookings = 0;
            $completedBookings = 0;
        }

        // Available rooms - using API
        try {
            $availableRooms = count($this->apiService->getRoomsByStatus('AVAILABLE'));
        } catch (\Exception $e) {
            Log::error('Error fetching available rooms', ['error' => $e->getMessage()]);
            $availableRooms = 0;
        }

        // Total guests - using API
        try {
            $allGuests = collect($this->apiService->getAllGuests());
            $totalGuests = $allGuests->filter(function ($guest) use ($startDate, $endDate) {
                $createdAt = isset($guest['createdAt']) ? Carbon::parse($guest['createdAt']) : null;
                return $createdAt && $createdAt->between($startDate, $endDate);
            })->count();
        } catch (\Exception $e) {
            Log::error('Error fetching guests', ['error' => $e->getMessage()]);
            $totalGuests = 0;
        }

        return [
            'room_revenue' => round($roomRevenue, 2),
            'total_bookings' => $totalBookings,
            'occupancy_rate' => round($occupancyRate, 1),
            'active_bookings' => $activeBookings,
            'pending_bookings' => $pendingBookings,
            'completed_bookings' => $completedBookings,
            'available_rooms' => $availableRooms,
            'total_guests' => $totalGuests,
            'total_rooms' => $totalRooms,
        ];
    }
    
    /**
     * Get total revenue from backend API (payments in date range, LKR, exclude REFUND).
     * Used when there is no local DB (e.g. App Platform) so dashboard shows accurate revenue.
     */
    private function getRevenueFromApi($startDate, $endDate)
    {
        try {
            $payments = $this->apiService->getAllPayments();
            if (!is_array($payments)) {
                return 0;
            }
            $total = 0;
            foreach ($payments as $payment) {
                $type = isset($payment['paymentType']) ? strtoupper((string) $payment['paymentType']) : '';
                if ($type === 'REFUND') {
                    continue;
                }
                $currency = isset($payment['currency']) ? strtoupper((string) $payment['currency']) : '';
                if ($currency !== 'LKR') {
                    continue;
                }
                $dateStr = $payment['paymentDate'] ?? null;
                if (!$dateStr) {
                    continue;
                }
                $paymentDate = Carbon::parse($dateStr);
                if (!$paymentDate->between($startDate, $endDate)) {
                    continue;
                }
                $amount = isset($payment['amount']) ? (float) $payment['amount'] : 0;
                $total += $amount;
            }
            return round($total, 2);
        } catch (\Exception $e) {
            Log::warning('getRevenueFromApi failed', ['error' => $e->getMessage()]);
            return 0;
        }
    }

    /**
     * Get expenses from backend API via HotelApiService (same HTTP client as revenue).
     * This works on deployed app (App Platform) where raw curl may fail.
     */
    private function getExpenses($startDate, $endDate)
    {
        $totalExpenses = 0;
        $breakdown = [
            'grn' => 0,
            'staff_meals' => 0,
            'salaries' => 0,
            'other' => 0
        ];

        try {
            $expenses = $this->apiService->getExpensesByDateRange($startDate, $endDate);
            if (!is_array($expenses)) {
                return [
                    'total' => 0,
                    'breakdown' => [
                        'grn' => 0,
                        'staff_meals' => 0,
                        'salaries' => 0,
                        'other' => 0
                    ]
                ];
            }
            foreach ($expenses as $expense) {
                $amount = isset($expense['amount']) ? (float) $expense['amount'] : 0;
                $type = isset($expense['expenseType']) ? strtoupper((string) $expense['expenseType']) : 'OTHER';

                $totalExpenses += $amount;

                switch ($type) {
                    case 'GRN':
                        $breakdown['grn'] += $amount;
                        break;
                    case 'STAFF_MEAL':
                        $breakdown['staff_meals'] += $amount;
                        break;
                    case 'SALARY':
                        $breakdown['salaries'] += $amount;
                        break;
                    default:
                        $breakdown['other'] += $amount;
                        break;
                }
            }
        } catch (\Exception $e) {
            Log::warning('Could not fetch expenses from backend API: ' . $e->getMessage());
        }

        return [
            'total' => round($totalExpenses, 2),
            'breakdown' => [
                'grn' => round($breakdown['grn'], 2),
                'staff_meals' => round($breakdown['staff_meals'], 2),
                'salaries' => round($breakdown['salaries'], 2),
                'other' => round($breakdown['other'], 2)
            ]
        ];
    }

    /**
     * Prepare chart data
     */
    private function prepareChartData($startDate, $endDate, $period)
    {
        $dateFormat = $period === 'day' ? 'H:00' : ($period === 'week' ? 'D' : 'M d');
        
        // Revenue based on ACTUAL PAYMENT DATES
        $revenueData = DB::table('payments')
            ->whereBetween('payment_date', [$startDate, $endDate])
            ->where('currency', 'LKR')
            ->where('payment_type', '!=', 'REFUND') // Exclude refunds
            ->select(
                DB::raw('DATE(payment_date) as date'),
                DB::raw('SUM(amount) as revenue')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');
        
        // Add restaurant orders without payment records (table orders paid at restaurant)
        try {
            // Get all payments with restaurant order IDs to identify which orders have payments
            $ordersWithPayments = DB::table('payments')
                ->whereBetween('payment_date', [$startDate, $endDate])
                ->whereNotNull('restaurant_order_id')
                ->where('restaurant_order_id', '!=', '')
                ->pluck('restaurant_order_id')
                ->toArray();
            
            // Get restaurant orders for the date range
            $restaurantOrders = DB::table('orders')
                ->whereBetween('order_date', [$startDate, $endDate])
                ->where(function($query) {
                    // Restaurant orders have tableNumber OR orderType is RESTAURANT
                    $query->whereNotNull('table_number')
                          ->where('table_number', '!=', '')
                          ->orWhere('order_type', 'RESTAURANT');
                })
                ->where(function($query) {
                    // Exclude room service (has roomNumber and no tableNumber)
                    $query->whereNull('room_number')
                          ->orWhere('room_number', '')
                          ->orWhereNotNull('table_number');
                })
                ->get();
            
            foreach ($restaurantOrders as $order) {
                // Check if order is completed (same logic as Night Audit)
                $isCompleted = false;
                
                if (!empty($order->invoice_number)) {
                    $isCompleted = true;
                } else if (!empty($order->status)) {
                    $isCompleted = !in_array($order->status, ['PENDING', 'PREPARING', 'READY', 'CANCELLED']);
                }
                
                if (!$isCompleted) {
                    continue;
                }
                
                // Check if order has a payment record
                $hasPaymentRecord = in_array($order->order_id, $ordersWithPayments);
                
                // Only include orders without payment records (table orders paid at restaurant)
                if (!$hasPaymentRecord && $order->total) {
                    $orderDate = Carbon::parse($order->order_date)->format('Y-m-d');
                    if (isset($revenueData[$orderDate])) {
                        $revenueData[$orderDate]->revenue += (float) $order->total;
                    } else {
                        $revenueData[$orderDate] = (object) [
                            'date' => $orderDate,
                            'revenue' => (float) $order->total
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            // Silently fail - restaurant orders are optional for chart data
            \Log::warning('Could not fetch restaurant orders for chart data: ' . $e->getMessage());
        }
        
        $revenueData = $revenueData->values()->map(function($item) use ($dateFormat) {
            return [
                'date' => Carbon::parse($item->date)->format($dateFormat),
                'revenue' => round($item->revenue, 2),
            ];
        });

        return [
            'revenue' => $revenueData,
        ];
    }

    /**
     * Get recent bookings
     */
    private function getRecentBookings($limit = 10)
    {
        try {
            $allBookings = collect($this->apiService->getAllBookings());
            
            return $allBookings->sortByDesc(function ($booking) {
                return $booking['bookedDate'] ?? '';
            })
            ->take($limit)
            ->map(function($booking) {
                $guest = null;
                $room = null;
                
                try {
                    $guest = $this->apiService->getGuestByGuestId($booking['guestId'] ?? '');
                } catch (\Exception $e) {
                    // Guest not found
                }
                
                try {
                    $room = $this->apiService->getRoomByRoomNumber($booking['roomNumber'] ?? '');
                } catch (\Exception $e) {
                    // Room not found
                }
                
                return [
                    'booking_id' => $booking['bookingId'] ?? 'Unknown',
                    'guest_name' => $guest ? ($guest['firstName'] ?? '') . ' ' . ($guest['lastName'] ?? '') : 'Unknown',
                    'room_number' => $booking['roomNumber'] ?? 'Unknown',
                    'room_type' => $room ? ($room['roomType'] ?? 'Unknown') : 'Unknown',
                    'check_in' => isset($booking['checkInTime']) ? Carbon::parse($booking['checkInTime'])->format('M d, Y') : 'N/A',
                    'check_out' => isset($booking['checkOutTime']) ? Carbon::parse($booking['checkOutTime'])->format('M d, Y') : 'N/A',
                    'nights' => $booking['numberOfNights'] ?? 0,
                    'guests' => ($booking['numberOfAdults'] ?? 0) + ($booking['numberOfChildren'] ?? 0),
                    'status' => $booking['status'] ?? 'UNKNOWN',
                    'booked_date' => isset($booking['bookedDate']) ? Carbon::parse($booking['bookedDate'])->format('M d, Y') : 'N/A',
                    'source' => $booking['bookingSource'] ?? 'UNKNOWN',
                ];
            })
            ->values();
        } catch (\Exception $e) {
            Log::error('Error fetching recent bookings', ['error' => $e->getMessage()]);
            return collect([]);
        }
    }

    /**
     * Get start date based on period
     */
    private function getStartDate($period)
    {
        switch ($period) {
            case 'day':
                return now()->startOfDay();
            case 'week':
                return now()->startOfWeek();
            case 'month':
                return now()->startOfMonth();
            case 'year':
                return now()->startOfYear();
            default:
                return now()->startOfMonth();
        }
    }

    /**
     * Inventory requests (Owner's Portal) - index page
     */
    public function inventoryRequestsIndex()
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $pendingRequests = [];
        $allRequests = [];

        try {
            $pendingRequests = $this->normalizeInventoryRequests($this->apiService->getPendingInventoryRequests());
        } catch (\Exception $e) {
            Log::warning('Failed to fetch pending inventory requests', ['error' => $e->getMessage()]);
        }

        try {
            $allRequests = $this->normalizeInventoryRequests($this->apiService->getInventoryRequests());
        } catch (\Exception $e) {
            Log::warning('Failed to fetch all inventory requests', ['error' => $e->getMessage()]);
        }

        return view('admin.inventory-requests', [
            'pendingRequests' => $pendingRequests,
            'allRequests' => $allRequests,
        ]);
    }

    /**
     * Normalize API response to array of arrays for the view (id, requestId, requestDate, requestedBy, reason, status, items).
     */
    private function normalizeInventoryRequests(array $list): array
    {
        $out = [];
        foreach ($list as $req) {
            $items = [];
            $rawItems = $req['items'] ?? [];
            foreach ($rawItems as $it) {
                $items[] = [
                    'ingredientName' => $it['ingredientName'] ?? '',
                    'quantity' => isset($it['quantity']) ? (float) $it['quantity'] : 0,
                    'unit' => $it['unit'] ?? '',
                    'itemReason' => $it['itemReason'] ?? '',
                ];
            }
            $out[] = [
                'id' => $req['id'] ?? null,
                'requestId' => $req['requestId'] ?? '',
                'requestDate' => $req['requestDate'] ?? null,
                'requestedBy' => $req['requestedBy'] ?? '',
                'reason' => $req['reason'] ?? '',
                'status' => $req['status'] ?? 'PENDING',
                'items' => $items,
            ];
        }
        return $out;
    }

    /**
     * Approve an inventory request (Owner's Portal) - sends approvalSource OWNER_PORTAL for 10+ item requests.
     */
    public function approveInventoryRequest(Request $request, $id)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $approvedBy = $request->input('approved_by', 'Owner (Web Portal)');
        $approvedItems = $request->input('approved_items', []);

        $payload = [
            'approvedBy' => $approvedBy,
            'approverRole' => 'OWNER',
            'approvalSource' => 'OWNER_PORTAL',
            'approvedItems' => [],
        ];
        foreach ($approvedItems as $item) {
            $name = $item['ingredient_name'] ?? '';
            $qty = isset($item['approved_quantity']) ? (float) $item['approved_quantity'] : 0;
            if ($name !== '') {
                $payload['approvedItems'][] = [
                    'ingredientName' => $name,
                    'approvedQuantity' => $qty,
                ];
            }
        }

        $backendUrl = env('BACKEND_API_URL', 'https://whale-app-wcsre.ondigitalocean.app/api/v1');
        try {
            $response = Http::timeout(15)
                ->withHeaders(['Content-Type' => 'application/json', 'Accept' => 'application/json'])
                ->post($backendUrl . '/inventory-requests/' . $id . '/approve', $payload);

            if ($response->successful()) {
                return redirect()->route('admin.inventory-requests')->withFragment('all-requests')->with('success', 'Inventory request approved successfully. It no longer appears in Pending and is shown as Approved below.');
            }
            $body = $response->json();
            $message = $body['message'] ?? $body['error'] ?? 'Approval failed.';
            return redirect()->route('admin.inventory-requests')->with('error', $message);
        } catch (\Exception $e) {
            Log::error('Inventory approve failed', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->route('admin.inventory-requests')->with('error', 'Failed to approve request: ' . $e->getMessage());
        }
    }

    /**
     * Reject an inventory request (Owner's Portal).
     */
    public function rejectInventoryRequest(Request $request, $id)
    {
        if (!session('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        $request->validate(['rejection_reason' => 'required|string|max:2000']);
        $approvedBy = $request->input('approved_by', 'Owner (Web Portal)');
        $rejectionReason = $request->input('rejection_reason');

        $payload = [
            'approvedBy' => $approvedBy,
            'approverRole' => 'OWNER',
            'approvalSource' => 'OWNER_PORTAL',
            'rejectionReason' => $rejectionReason,
        ];

        $backendUrl = env('BACKEND_API_URL', 'https://whale-app-wcsre.ondigitalocean.app/api/v1');
        try {
            $response = Http::timeout(15)
                ->withHeaders(['Content-Type' => 'application/json', 'Accept' => 'application/json'])
                ->post($backendUrl . '/inventory-requests/' . $id . '/reject', $payload);

            if ($response->successful()) {
                return redirect()->route('admin.inventory-requests')->withFragment('all-requests')->with('success', 'Inventory request rejected. It no longer appears in Pending and is shown as Rejected below.');
            }
            $body = $response->json();
            $message = $body['message'] ?? $body['error'] ?? 'Rejection failed.';
            return redirect()->route('admin.inventory-requests')->with('error', $message);
        } catch (\Exception $e) {
            Log::error('Inventory reject failed', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->route('admin.inventory-requests')->with('error', 'Failed to reject request: ' . $e->getMessage());
        }
    }
}


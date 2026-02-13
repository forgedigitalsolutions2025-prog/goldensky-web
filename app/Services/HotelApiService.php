<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class HotelApiService
{
    private $apiBaseUrl;
    private $timeout;

    public function __construct()
    {
        // Prefer API_BASE_URL (host only, no /api/v1). If unset, derive from BACKEND_API_URL so one env var can drive both.
        $base = env('API_BASE_URL');
        if (empty($base)) {
            $backend = env('BACKEND_API_URL', 'https://whale-app-wcsre.ondigitalocean.app/api/v1');
            $this->apiBaseUrl = preg_replace('#/api/v1/?$#', '', $backend);
        } else {
            $this->apiBaseUrl = rtrim($base, '/');
        }
        $this->timeout = 15; // seconds (increased for slow backends)
    }

    /**
     * Return the backend API base URL (e.g. https://whale-app-xxx.ondigitalocean.app/api/v1).
     * Use this for any direct HTTP calls (e.g. approve/reject) so they hit the same backend as list/fetch.
     */
    public function getBackendApiBaseUrl(): string
    {
        return rtrim($this->apiBaseUrl, '/') . '/api/v1';
    }

    /**
     * Make API request with error handling and retry logic
     */
    private function makeRequest(string $method, string $endpoint, array $data = [], int $retries = 2)
    {
        $url = $this->apiBaseUrl . '/api/v1' . $endpoint;
        
        for ($attempt = 0; $attempt <= $retries; $attempt++) {
            try {
                $response = Http::timeout($this->timeout)
                    ->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ])
                    ->{strtolower($method)}($url, $data);

                if ($response->successful()) {
                    return [
                        'success' => true,
                        'data' => $response->json(),
                        'status' => $response->status()
                    ];
                }

                // If not successful and not last attempt, retry
                if ($attempt < $retries) {
                    sleep(1); // Wait 1 second before retry
                    continue;
                }

                // Last attempt failed
                $responseBody = $response->body();
                $responseJson = $response->json();
                
                Log::error('API request failed', [
                    'method' => $method,
                    'endpoint' => $endpoint,
                    'status' => $response->status(),
                    'body' => $responseBody,
                    'json' => $responseJson,
                    'request_data' => $method !== 'GET' ? $data : null
                ]);

                // Try to extract meaningful error message
                $errorMessage = 'API request failed';
                if (isset($responseJson['message'])) {
                    $errorMessage = $responseJson['message'];
                } elseif (isset($responseJson['error'])) {
                    $errorMessage = is_array($responseJson['error']) ? json_encode($responseJson['error']) : $responseJson['error'];
                } elseif (!empty($responseBody)) {
                    // Try to parse as JSON error
                    $decoded = json_decode($responseBody, true);
                    if (isset($decoded['message'])) {
                        $errorMessage = $decoded['message'];
                    } elseif (isset($decoded['error'])) {
                        $errorMessage = is_array($decoded['error']) ? json_encode($decoded['error']) : $decoded['error'];
                    }
                }
                
                if ($response->status() === 400) {
                    $errorMessage = 'Invalid data provided: ' . $errorMessage;
                }

                return [
                    'success' => false,
                    'error' => $errorMessage,
                    'status' => $response->status(),
                    'response_body' => $responseBody
                ];
            } catch (\Exception $e) {
                if ($attempt < $retries) {
                    sleep(1);
                    continue;
                }

                Log::error('API request exception', [
                    'method' => $method,
                    'endpoint' => $endpoint,
                    'error' => $e->getMessage()
                ]);

                return [
                    'success' => false,
                    'error' => 'Connection error: ' . $e->getMessage(),
                    'status' => 0
                ];
            }
        }
    }

    // ==================== ROOMS ====================

    /**
     * Get all rooms with calculated status
     */
    public function getAllRooms()
    {
        $cacheKey = 'api_rooms_all';
        $cached = Cache::get($cacheKey);
        if ($cached !== null) {
            return $cached;
        }
        $result = $this->makeRequest('GET', '/rooms/with-calculated-status');
        $data = $result['success'] && is_array($result['data'] ?? null) ? $result['data'] : [];
        if (!empty($data)) {
            Cache::put($cacheKey, $data, 120); // 2 minutes
        }
        return $data;
    }

    /**
     * Get room by ID
     */
    public function getRoomById($id)
    {
        $result = $this->makeRequest('GET', "/rooms/{$id}");
        return $result['success'] ? $result['data'] : null;
    }

    /**
     * Get room by room number
     */
    public function getRoomByRoomNumber($roomNumber)
    {
        $result = $this->makeRequest('GET', "/rooms/room-number/{$roomNumber}");
        return $result['success'] ? $result['data'] : null;
    }

    /**
     * Get rooms by status
     */
    public function getRoomsByStatus($status)
    {
        $result = $this->makeRequest('GET', "/rooms/status/{$status}");
        return $result['success'] ? $result['data'] : [];
    }

    // ==================== BOOKINGS ====================

    /**
     * Get all bookings
     */
    public function getAllBookings()
    {
        $result = $this->makeRequest('GET', '/bookings');
        return $result['success'] ? $result['data'] : [];
    }

    /**
     * Get booking by ID
     */
    public function getBookingById($id)
    {
        $result = $this->makeRequest('GET', "/bookings/{$id}");
        return $result['success'] ? $result['data'] : null;
    }

    /**
     * Get booking by booking ID
     */
    public function getBookingByBookingId($bookingId)
    {
        $result = $this->makeRequest('GET', "/bookings/booking-id/{$bookingId}");
        return $result['success'] ? $result['data'] : null;
    }

    /**
     * Get bookings by guest ID
     */
    public function getBookingsByGuest($guestId)
    {
        $result = $this->makeRequest('GET', "/bookings/guest/{$guestId}");
        return $result['success'] ? $result['data'] : [];
    }

    /**
     * Get bookings by room number
     */
    public function getBookingsByRoom($roomNumber)
    {
        $result = $this->makeRequest('GET', "/bookings/room/{$roomNumber}");
        return $result['success'] ? $result['data'] : [];
    }

    /**
     * Get bookings by status
     */
    public function getBookingsByStatus($status)
    {
        $result = $this->makeRequest('GET', "/bookings/status/{$status}");
        return $result['success'] ? $result['data'] : [];
    }

    /**
     * Create booking via API
     */
    public function createBooking(array $bookingData)
    {
        // Convert Laravel date format to API format if needed
        if (isset($bookingData['check_in_time']) && is_string($bookingData['check_in_time'])) {
            $bookingData['check_in_time'] = date('Y-m-d\TH:i:s', strtotime($bookingData['check_in_time']));
        }
        if (isset($bookingData['check_out_time']) && is_string($bookingData['check_out_time'])) {
            $bookingData['check_out_time'] = date('Y-m-d\TH:i:s', strtotime($bookingData['check_out_time']));
        }
        if (isset($bookingData['booked_date']) && is_string($bookingData['booked_date'])) {
            $bookingData['booked_date'] = date('Y-m-d\TH:i:s', strtotime($bookingData['booked_date']));
        }

        $result = $this->makeRequest('POST', '/bookings', $bookingData);
        
        if ($result['success']) {
            // Clear rooms cache since availability changed
            Cache::forget('api_rooms_all');
            return $result['data'];
        }
        
        throw new \Exception($result['error'] ?? 'Failed to create booking');
    }

    /**
     * Update booking
     */
    public function updateBooking($id, array $bookingData)
    {
        $result = $this->makeRequest('PUT', "/bookings/{$id}", $bookingData);
        
        if ($result['success']) {
            Cache::forget('api_rooms_all');
            return $result['data'];
        }
        
        throw new \Exception($result['error'] ?? 'Failed to update booking');
    }

    /**
     * Update booking status
     */
    public function updateBookingStatus($id, $status)
    {
        $result = $this->makeRequest('PATCH', "/bookings/{$id}/status", ['status' => $status]);
        
        if ($result['success']) {
            Cache::forget('api_rooms_all');
            return $result['data'];
        }
        
        throw new \Exception($result['error'] ?? 'Failed to update booking status');
    }

    /**
     * Delete booking
     */
    public function deleteBooking($id)
    {
        $result = $this->makeRequest('DELETE', "/bookings/{$id}");
        
        if ($result['success']) {
            Cache::forget('api_rooms_all');
            return true;
        }
        
        throw new \Exception($result['error'] ?? 'Failed to delete booking');
    }

    // ==================== PAYMENTS ====================

    /**
     * Get all payments from the backend (for revenue calculation when no local DB).
     */
    public function getAllPayments()
    {
        $result = $this->makeRequest('GET', '/payments');
        return $result['success'] ? ($result['data'] ?? []) : [];
    }

    /**
     * Get expenses for a date range from the backend (for dashboard when no local DB).
     * Uses the same HTTP client as other API calls so it works on App Platform.
     */
    public function getExpensesByDateRange($startDate, $endDate)
    {
        $startStr = $startDate->format('Y-m-d');
        $endStr = $endDate->format('Y-m-d');
        $result = $this->makeRequest('GET', '/expenses/date-range', [
            'startDate' => $startStr,
            'endDate' => $endStr,
        ]);
        return $result['success'] ? ($result['data'] ?? []) : [];
    }

    /**
     * Get all inventory requests from the backend (Owner's Portal).
     */
    public function getInventoryRequests()
    {
        $result = $this->makeRequest('GET', '/inventory-requests');
        return $result['success'] && is_array($result['data'] ?? null) ? $result['data'] : [];
    }

    /**
     * Get pending inventory requests from the backend (Owner's Portal).
     */
    public function getPendingInventoryRequests()
    {
        $result = $this->makeRequest('GET', '/inventory-requests/pending');
        return $result['success'] && is_array($result['data'] ?? null) ? $result['data'] : [];
    }

    // ==================== GUESTS ====================

    /**
     * Get all guests
     */
    public function getAllGuests()
    {
        $result = $this->makeRequest('GET', '/guests');
        return $result['success'] ? $result['data'] : [];
    }

    /**
     * Get guest by ID
     */
    public function getGuestById($id)
    {
        $result = $this->makeRequest('GET', "/guests/{$id}");
        return $result['success'] ? $result['data'] : null;
    }

    /**
     * Get guest by guest ID
     */
    public function getGuestByGuestId($guestId)
    {
        $result = $this->makeRequest('GET', "/guests/guest-id/{$guestId}");
        return $result['success'] ? $result['data'] : null;
    }

    /**
     * Search guests
     */
    public function searchGuests($query)
    {
        $result = $this->makeRequest('GET', "/guests/search", ['query' => $query]);
        return $result['success'] ? $result['data'] : [];
    }

    /**
     * Create guest via API
     */
    public function createGuest(array $guestData)
    {
        Log::info('Creating guest via API', ['data' => $guestData]);
        $result = $this->makeRequest('POST', '/guests', $guestData);
        
        if ($result['success']) {
            return $result['data'];
        }
        
        // Log detailed error information
        $errorDetails = [
            'error' => $result['error'] ?? 'Unknown error',
            'status' => $result['status'] ?? 'unknown',
            'guest_data' => $guestData
        ];
        Log::error('Failed to create guest', $errorDetails);
        
        $errorMessage = $result['error'] ?? 'Failed to create guest';
        if (isset($result['status']) && $result['status'] >= 400) {
            $errorMessage .= ' (Status: ' . $result['status'] . ')';
        }
        
        throw new \Exception($errorMessage);
    }

    /**
     * Update guest
     */
    public function updateGuest($id, array $guestData)
    {
        $result = $this->makeRequest('PUT', "/guests/{$id}", $guestData);
        
        if ($result['success']) {
            return $result['data'];
        }
        
        throw new \Exception($result['error'] ?? 'Failed to update guest');
    }

    /**
     * Delete guest
     */
    public function deleteGuest($id)
    {
        $result = $this->makeRequest('DELETE', "/guests/{$id}");
        return $result['success'];
    }

    // ==================== MENU ITEMS ====================

    /**
     * Get available menu items
     */
    public function getAvailableMenuItems()
    {
        $cacheKey = 'api_menu_items_available';
        
        return Cache::remember($cacheKey, 300, function () { // Cache for 5 minutes
            $result = $this->makeRequest('GET', '/menu-items/available');
            return $result['success'] ? $result['data'] : [];
        });
    }

    /**
     * Get all menu items
     */
    public function getAllMenuItems()
    {
        $result = $this->makeRequest('GET', '/menu-items');
        return $result['success'] ? $result['data'] : [];
    }

    /**
     * Get menu item by ID
     */
    public function getMenuItemById($id)
    {
        $result = $this->makeRequest('GET', "/menu-items/{$id}");
        return $result['success'] ? $result['data'] : null;
    }

    /**
     * Get menu items by category
     */
    public function getMenuItemsByCategory($category)
    {
        $result = $this->makeRequest('GET', "/menu-items/category/{$category}");
        return $result['success'] ? $result['data'] : [];
    }
}










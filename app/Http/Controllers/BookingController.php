<?php

namespace App\Http\Controllers;

use App\Services\HotelApiService;
use App\Notifications\BookingConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    private $apiService;

    public function __construct(HotelApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Show booking form
     */
    public function create(Request $request)
    {
        $roomId = $request->input('room_id');
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        $room = null;
        if ($roomId) {
            try {
                $roomData = $this->apiService->getRoomById($roomId);
                if ($roomData) {
                    // Convert API array response to object with snake_case properties for Blade template
                    $room = (object) [
                        'id' => $roomData['id'] ?? $roomData['roomId'] ?? null,
                        'room_number' => $roomData['roomNumber'] ?? $roomData['room_number'] ?? null,
                        'room_type' => $roomData['roomType'] ?? $roomData['room_type'] ?? null,
                        'max_occupancy' => $roomData['maxOccupancy'] ?? $roomData['max_occupancy'] ?? null,
                        'price_per_night' => $roomData['pricePerNight'] ?? $roomData['price_per_night'] ?? null,
                        'price_room_only' => $roomData['priceRoomOnly'] ?? $roomData['price_room_only'] ?? $roomData['pricePerNight'] ?? $roomData['price_per_night'] ?? null,
                        'price_bed_breakfast' => $roomData['priceBedBreakfast'] ?? $roomData['price_bed_breakfast'] ?? null,
                        'price_half_board' => $roomData['priceHalfBoard'] ?? $roomData['price_half_board'] ?? null,
                        'price_full_board' => $roomData['priceFullBoard'] ?? $roomData['price_full_board'] ?? null,
                    ];
                }
            } catch (\Exception $e) {
                Log::error('Error fetching room for booking form', ['room_id' => $roomId, 'error' => $e->getMessage()]);
            }
        }
        
        // Get authenticated user and guest details for pre-filling form
        $user = auth()->user();
        $guest = null;
        
        // Try to find guest by email via API
        if ($user && $user->email) {
            try {
                $guests = $this->apiService->searchGuests($user->email);
                $guest = !empty($guests) ? $guests[0] : null;
            } catch (\Exception $e) {
                Log::debug('Guest not found via API', ['email' => $user->email]);
            }
        }
        
        // Split user name into first and last name if guest record doesn't exist
        if (!$guest && $user) {
            $nameParts = explode(' ', $user->name, 2);
            $guest = (object) [
                'firstName' => $nameParts[0],
                'lastName' => isset($nameParts[1]) ? $nameParts[1] : '',
                'email' => $user->email,
                'phone' => '',
                'address' => '',
                'nationality' => '',
                'passportNumber' => '',
            ];
        }

        return view('bookings.create', compact('room', 'checkIn', 'checkOut', 'user', 'guest'));
    }

    /**
     * Store booking via API
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'nationality' => 'nullable|string|max:50',
            'passport_number' => 'nullable|string|max:50',
            'room_number' => 'required|string',
            'package_type' => 'required|string|in:ROOM_ONLY,BED_AND_BREAKFAST,HALF_BOARD,FULL_BOARD',
            'check_in_time' => 'required|date|after_or_equal:today',
            'check_out_time' => 'required|date|after:check_in_time',
            'number_of_adults' => 'required|integer|min:1',
            'number_of_children' => 'nullable|integer|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Additional validation: Check total guests against room capacity
        $validator->after(function ($validator) use ($request) {
            try {
                $room = $this->apiService->getRoomByRoomNumber($request->room_number);
            if ($room) {
                $totalGuests = $request->number_of_adults + ($request->number_of_children ?? 0);
                    if ($totalGuests > $room['maxOccupancy']) {
                    $validator->errors()->add('number_of_adults', 
                            'Total guests (' . $totalGuests . ') exceeds room capacity (' . $room['maxOccupancy'] . ')');
                    }
                } else {
                    $validator->errors()->add('room_number', 'Selected room not found.');
                }
            } catch (\Exception $e) {
                Log::error('Error validating room capacity', ['error' => $e->getMessage()]);
                $validator->errors()->add('room_number', 'Unable to verify room availability.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        try {
            // First, create or find guest via API
            $guest = null;
            try {
                // Try to find existing guest by email
                $guests = $this->apiService->searchGuests($validated['email']);
                if (!empty($guests)) {
                    $guest = $guests[0];
                    // Update guest info if needed
                    $this->apiService->updateGuest($guest['id'], [
                        'firstName' => $validated['first_name'],
                        'lastName' => $validated['last_name'],
                        'phone' => $validated['phone'],
                        'address' => $validated['address'] ?? null,
                        'nationality' => $validated['nationality'] ?? null,
                        'passportNumber' => $validated['passport_number'] ?? null,
                    ]);
            }
            } catch (\Exception $e) {
                Log::debug('Guest not found, will create new one', ['email' => $validated['email']]);
            }

            // Create guest if not found
            if (!$guest) {
                // Generate unique guest ID in format G-{number}
                // Try to get next available guest ID from API or generate one
                $guestId = null;
                try {
                    // Try to get all guests to find the next sequence number
                    $allGuests = $this->apiService->getAllGuests();
                    if (!empty($allGuests)) {
                        $maxSeq = 0;
                        foreach ($allGuests as $g) {
                            if (isset($g['guestId']) && preg_match('/^G-(\d+)$/', $g['guestId'], $matches)) {
                                $seq = (int)$matches[1];
                                if ($seq > $maxSeq) {
                                    $maxSeq = $seq;
                                }
                            }
                        }
                        $guestId = 'G-' . str_pad($maxSeq + 1, 6, '0', STR_PAD_LEFT);
                    } else {
                        $guestId = 'G-000001';
                    }
                } catch (\Exception $e) {
                    // If we can't get all guests, generate a timestamp-based ID
                    Log::debug('Could not fetch all guests for ID generation', ['error' => $e->getMessage()]);
                    $guestId = 'G-' . str_pad(time() % 1000000, 6, '0', STR_PAD_LEFT);
                }
                
                $guest = $this->apiService->createGuest([
                    'guestId' => $guestId,
                    'firstName' => $validated['first_name'],
                    'lastName' => $validated['last_name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'] ?? null,
                    'nationality' => $validated['nationality'] ?? null,
                    'passportNumber' => $validated['passport_number'] ?? null,
                ]);
            }

            // Calculate number of nights
            $checkIn = new \DateTime($validated['check_in_time']);
            $checkOut = new \DateTime($validated['check_out_time']);
            $numberOfNights = $checkIn->diff($checkOut)->days;

            // Generate unique booking ID (format: BK-0001, BK-0002, etc.)
            $bookingId = $this->generateNextBookingId();

            // Format dates for Java LocalDateTime (ISO 8601 format: YYYY-MM-DDTHH:mm:ss)
            // Set check-in time to 14:00 (2 PM) and check-out time to 11:00 (11 AM)
            $checkInDateTime = (new \DateTime($validated['check_in_time']))->setTime(14, 0, 0);
            $checkOutDateTime = (new \DateTime($validated['check_out_time']))->setTime(11, 0, 0);
            $bookedDateTime = now();

            // Create booking via API
            $booking = $this->apiService->createBooking([
                'bookingId' => $bookingId,
                'guestId' => $guest['guestId'],
                'roomNumber' => $validated['room_number'],
                'packageType' => $validated['package_type'],
                'checkInTime' => $checkInDateTime->format('Y-m-d\TH:i:s'),
                'checkOutTime' => $checkOutDateTime->format('Y-m-d\TH:i:s'),
                'bookedDate' => $bookedDateTime->format('Y-m-d\TH:i:s'),
                'numberOfNights' => $numberOfNights,
                'numberOfAdults' => (int)$validated['number_of_adults'],
                'numberOfChildren' => (int)($validated['number_of_children'] ?? 0),
                'advancePayment' => 0,
                'status' => 'PENDING', // API will handle status
                'bookingSource' => 'WEBSITE',
                'guestType' => 'FIT_LOCAL', // Default for web bookings
                'notes' => $validated['notes'] ?? null,
            ]);

            Log::info('Booking created via API', [
                'booking_id' => $booking['bookingId'] ?? 'unknown',
                'guest_id' => $guest['guestId'],
                'room_number' => $validated['room_number'],
            ]);

            // Get room details for email
            $room = $this->apiService->getRoomByRoomNumber($validated['room_number']);

            // Send booking confirmation email to guest
            try {
                // Convert API response to object for notification
                $bookingObj = (object) $booking;
                $guestObj = (object) $guest;
                $roomObj = (object) $room;
                
                // Note: You may need to create a custom notification that works with API data
                // For now, we'll just log it
                Log::info('Booking confirmation email should be sent', [
                    'booking_id' => $booking['bookingId'] ?? 'unknown',
                    'guest_email' => $guest['email'],
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send booking confirmation email', [
                    'booking_id' => $booking['bookingId'] ?? 'unknown',
                    'guest_email' => $guest['email'],
                    'error' => $e->getMessage(),
                ]);
                // Don't fail the booking if email fails
            }

            return redirect()->route('bookings.success', $booking['bookingId'])
                ->with('success', 'Your booking has been submitted successfully!');

        } catch (\Exception $e) {
            Log::error('Booking creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['password', 'password_confirmation']),
            ]);

            // Provide more detailed error messages
            $errorMessage = 'An error occurred while processing your booking.';
            
            $message = $e->getMessage();
            if (strpos($message, 'already booked') !== false || 
                strpos($message, 'not available') !== false ||
                strpos($message, 'capacity') !== false ||
                strpos($message, 'overlap') !== false) {
                $errorMessage = $message;
            } elseif (strpos($message, 'create guest') !== false || strpos($message, 'guest') !== false) {
                $errorMessage = 'Unable to process guest information. Please check your details and try again.';
            } elseif (strpos($message, 'Connection error') !== false || strpos($message, 'timeout') !== false) {
                $errorMessage = 'Unable to connect to the booking system. Please try again in a moment.';
            } elseif (strpos($message, 'Status:') !== false) {
                // Include status code in error message
                $errorMessage = 'Booking request failed: ' . $message;
            }

            return redirect()->back()
                ->with('error', $errorMessage)
                ->withInput();
        }
    }

    /**
     * Show booking success page
     */
    public function success($bookingId)
    {
        try {
            $bookingData = $this->apiService->getBookingByBookingId($bookingId);
            
            if (!$bookingData) {
                abort(404, 'Booking not found');
            }

            // Convert camelCase API keys to snake_case for Blade template
            $booking = (object) [
                'booking_id' => $bookingData['bookingId'] ?? null,
                'guest_id' => $bookingData['guestId'] ?? null,
                'room_number' => $bookingData['roomNumber'] ?? null,
                'check_in_time' => $bookingData['checkInTime'] ?? null,
                'check_out_time' => $bookingData['checkOutTime'] ?? null,
                'booked_date' => $bookingData['bookedDate'] ?? null,
                'number_of_nights' => $bookingData['numberOfNights'] ?? 0,
                'number_of_adults' => $bookingData['numberOfAdults'] ?? 1,
                'number_of_children' => $bookingData['numberOfChildren'] ?? 0,
                'advance_payment' => $bookingData['advancePayment'] ?? 0,
                'status' => $bookingData['status'] ?? 'PENDING',
                'package_type' => $bookingData['packageType'] ?? null,
                'booking_source' => $bookingData['bookingSource'] ?? null,
                'guest_type' => $bookingData['guestType'] ?? null,
                'notes' => $bookingData['notes'] ?? null,
            ];
            
            $guestData = $this->apiService->getGuestByGuestId($booking->guest_id);
            $roomData = $this->apiService->getRoomByRoomNumber($booking->room_number);
            
            // Convert guest to object with snake_case keys
            if ($guestData) {
                $guest = (object) [
                    'guest_id' => $guestData['guestId'] ?? null,
                    'first_name' => $guestData['firstName'] ?? null,
                    'last_name' => $guestData['lastName'] ?? null,
                    'email' => $guestData['email'] ?? null,
                    'phone' => $guestData['phone'] ?? null,
                    'address' => $guestData['address'] ?? null,
                    'nationality' => $guestData['nationality'] ?? null,
                    'passport_number' => $guestData['passportNumber'] ?? null,
                ];
            } else {
                $guest = null;
            }
            
            // Convert room to object with snake_case keys
            if ($roomData) {
                $room = (object) [
                    'room_number' => $roomData['roomNumber'] ?? null,
                    'room_type' => $roomData['roomType'] ?? null,
                    'max_occupancy' => $roomData['maxOccupancy'] ?? 1,
                    'price_per_night' => $roomData['pricePerNight'] ?? $roomData['priceRoomOnly'] ?? null,
                    'status' => $roomData['status'] ?? null,
                ];
            } else {
                $room = null;
            }

        return view('bookings.success', compact('booking', 'guest', 'room'));
        } catch (\Exception $e) {
            Log::error('Error fetching booking details', [
                'booking_id' => $bookingId,
                'error' => $e->getMessage()
            ]);
            
            abort(404, 'Booking not found');
        }
    }
    
    /**
     * Generate next booking ID in format BK-0001, BK-0002, etc.
     * Fetches existing bookings from API to find the highest sequence number.
     */
    private function generateNextBookingId(): string
    {
        try {
            // Fetch all bookings from API
            $bookings = $this->apiService->getAllBookings();
            
            $maxSeq = 0;
            foreach ($bookings as $booking) {
                if (isset($booking['bookingId']) && preg_match('/^BK-(\d+)$/', $booking['bookingId'], $matches)) {
                    $seq = (int)$matches[1];
                    if ($seq > $maxSeq) {
                        $maxSeq = $seq;
                    }
                }
            }
            
            // Generate next booking ID
            $nextSeq = $maxSeq + 1;
            return sprintf('BK-%04d', $nextSeq);
        } catch (\Exception $e) {
            // If we can't fetch bookings, generate a timestamp-based ID as fallback
            Log::debug('Could not fetch all bookings for ID generation', ['error' => $e->getMessage()]);
            $timestampSeq = (time() % 10000); // Use last 4 digits of timestamp
            return sprintf('BK-%04d', $timestampSeq);
        }
    }
}

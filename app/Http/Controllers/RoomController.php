<?php

namespace App\Http\Controllers;

use App\Services\HotelApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    private $apiService;

    public function __construct(HotelApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Display available rooms
     */
    public function index(Request $request)
    {
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        try {
            // Get all rooms from API (with calculated status)
            $allRooms = $this->apiService->getAllRooms();
            
            if (empty($allRooms)) {
                $rooms = collect([]);
            } else {
                // Filter rooms based on availability if dates provided
        if ($checkIn && $checkOut) {
                    $rooms = collect($allRooms)->filter(function ($room) use ($checkIn, $checkOut) {
                        // Check if room is available for the specified dates
                        // Get bookings for this room
                        $bookings = $this->apiService->getBookingsByRoom($room['roomNumber']);
                        
                        // Filter out cancelled bookings
                        $activeBookings = collect($bookings)->filter(function ($booking) {
                            return $booking['status'] !== 'CANCELLED';
                        });
                        
                        // Check for overlapping bookings
                        $hasOverlap = $activeBookings->contains(function ($booking) use ($checkIn, $checkOut) {
                            $bookingCheckIn = date('Y-m-d', strtotime($booking['checkInTime']));
                            $bookingCheckOut = date('Y-m-d', strtotime($booking['checkOutTime']));
                            
                            // Overlap: booking checkout > requested checkin AND booking checkin < requested checkout
                            return $bookingCheckOut > $checkIn && $bookingCheckIn < $checkOut;
                        });
                        
                        return !$hasOverlap;
                    })->values();
        } else {
                    // No dates provided, show rooms that are currently available
                    $rooms = collect($allRooms)->filter(function ($room) {
                        // Room is available if status is AVAILABLE
                        return isset($room['status']) && $room['status'] === 'AVAILABLE';
                    })->values();
                }
        }

        return view('rooms.index', compact('rooms', 'checkIn', 'checkOut'));
        } catch (\Exception $e) {
            Log::error('Error fetching rooms', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            $rooms = collect([]);
            return view('rooms.index', compact('rooms', 'checkIn', 'checkOut'));
        }
    }

    /**
     * Show room details
     */
    public function show($id)
    {
        try {
            $room = $this->apiService->getRoomById($id);
            
            if (!$room) {
                abort(404, 'Room not found');
            }
            
        return view('rooms.show', compact('room'));
        } catch (\Exception $e) {
            Log::error('Error fetching room', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            
            abort(404, 'Room not found');
    }
}
}

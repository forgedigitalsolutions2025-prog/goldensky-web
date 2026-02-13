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
     * Uses one getAllBookings() when dates are provided instead of N getBookingsByRoom() calls (avoids timeout on hosted app).
     */
    public function index(Request $request)
    {
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        try {
            $allRooms = $this->apiService->getAllRooms();

            if (empty($allRooms)) {
                $rooms = collect([]);
            } elseif ($checkIn && $checkOut) {
                // One API call for all bookings, then filter in PHP (avoids N+1 and timeouts)
                $allBookings = $this->apiService->getAllBookings();
                $activeBookings = collect($allBookings)->filter(function ($booking) {
                    return ($booking['status'] ?? '') !== 'CANCELLED';
                });

                $rooms = collect($allRooms)->filter(function ($room) use ($checkIn, $checkOut, $activeBookings) {
                    $roomNumber = $room['roomNumber'] ?? $room['room_number'] ?? null;
                    if ($roomNumber === null) {
                        return true;
                    }
                    $roomBookings = $activeBookings->where('roomNumber', $roomNumber)->values();
                    if ($roomBookings->isEmpty()) {
                        return true;
                    }
                    $hasOverlap = $roomBookings->contains(function ($booking) use ($checkIn, $checkOut) {
                        $bookingCheckIn = isset($booking['checkInTime']) ? date('Y-m-d', strtotime($booking['checkInTime'])) : null;
                        $bookingCheckOut = isset($booking['checkOutTime']) ? date('Y-m-d', strtotime($booking['checkOutTime'])) : null;
                        if (!$bookingCheckIn || !$bookingCheckOut) {
                            return false;
                        }
                        return $bookingCheckOut > $checkIn && $bookingCheckIn < $checkOut;
                    });
                    return !$hasOverlap;
                })->values();
            } else {
                // No dates: show rooms that are currently available
                $rooms = collect($allRooms)->filter(function ($room) {
                    return isset($room['status']) && $room['status'] === 'AVAILABLE';
                })->values();
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

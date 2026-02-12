<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'room_number',
        'room_type',
        'price_per_night',
        'max_occupancy',
        'status',
        'price_room_only',
        'price_bed_breakfast',
        'price_half_board',
        'price_full_board',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'max_occupancy' => 'integer',
        'price_room_only' => 'decimal:2',
        'price_bed_breakfast' => 'decimal:2',
        'price_half_board' => 'decimal:2',
        'price_full_board' => 'decimal:2',
    ];

    /**
     * Get price for a specific package type
     */
    public function getPriceForPackage($packageType)
    {
        if (!$packageType) {
            return $this->price_per_night;
        }

        switch (strtoupper($packageType)) {
            case 'ROOM_ONLY':
                return $this->price_room_only ?? $this->price_per_night;
            case 'BED_AND_BREAKFAST':
                return $this->price_bed_breakfast ?? $this->price_per_night;
            case 'HALF_BOARD':
                return $this->price_half_board ?? $this->price_per_night;
            case 'FULL_BOARD':
                return $this->price_full_board ?? $this->price_per_night;
            default:
                return $this->price_per_night;
        }
    }

    /**
     * Check if room is available for date range
     * Availability is determined by booking overlaps, not current room status
     * (A room can be CHECKED_IN today but still available for future dates)
     */
    public function isAvailableForDates($checkIn, $checkOut)
    {
        // Check for overlapping bookings
        // Only check bookings that are not cancelled (same as Reception app logic)
        // Overlap occurs if: existing_checkout > requested_checkin AND existing_checkin < requested_checkout
        // Use DATE() to compare only the date part, not the full datetime
        $overlapping = Booking::where('room_number', $this->room_number)
            ->where('status', '!=', 'CANCELLED')
            ->where('check_in_time', '!=', null)
            ->where('check_out_time', '!=', null)
            ->where(function ($query) use ($checkIn, $checkOut) {
                // Overlap: existing checkout date > requested checkin date AND existing checkin date < requested checkout date
                $query->whereRaw('DATE(check_out_time) > ?', [$checkIn])
                      ->whereRaw('DATE(check_in_time) < ?', [$checkOut]);
            })
            ->exists();

        return !$overlapping;
    }

    /**
     * Check if room is currently available (for today)
     * Uses the same logic as the backend API - calculates status from bookings
     */
    public function isCurrentlyAvailable()
    {
        $today = now()->toDateString();
        
        // Get all non-cancelled bookings for this room
        $bookings = Booking::where('room_number', $this->room_number)
            ->where('status', '!=', 'CANCELLED')
            ->where('check_in_time', '!=', null)
            ->where('check_out_time', '!=', null)
            ->get();
        
        // Check for CHECKED_IN bookings (highest priority)
        foreach ($bookings as $booking) {
            if ($booking->status === 'CHECKED_IN') {
                return false; // Room is checked in, not available
            }
        }
        
        // Check for PENDING bookings that include today or are in the future
        foreach ($bookings as $booking) {
            if ($booking->status === 'PENDING') {
                $checkInDate = Carbon::parse($booking->check_in_time)->toDateString();
                $checkOutDate = $booking->check_out_time 
                    ? Carbon::parse($booking->check_out_time)->toDateString()
                    : Carbon::parse($checkInDate)->addDays($booking->number_of_nights)->toDateString();
                
                // If today is within the booking period (today >= checkInDate && today <= checkOutDate), room is booked
                if ($today >= $checkInDate && $today <= $checkOutDate) {
                    return false; // Room is booked for today
                }
                // If check-in is today or in the future (checkInDate >= today), room is booked
                // This catches future bookings that haven't started yet
                if ($checkInDate >= $today) {
                    return false; // Room has a booking starting today or in the future
                }
            }
        }
        
        // No active bookings, room is available
        return true;
    }

    /**
     * Get room status for specific date range
     * Returns the status relevant to the selected dates, not the current status
     */
    public function getStatusForDates($checkIn, $checkOut)
    {
        if (!$checkIn || !$checkOut) {
            return $this->status; // Return current status if no dates provided
        }

        // Check for overlapping bookings
        $overlappingBookings = Booking::where('room_number', $this->room_number)
            ->where('status', '!=', 'CANCELLED')
            ->where('check_in_time', '!=', null)
            ->where('check_out_time', '!=', null)
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereRaw('DATE(check_out_time) > ?', [$checkIn])
                      ->whereRaw('DATE(check_in_time) < ?', [$checkOut]);
            })
            ->get();

        if ($overlappingBookings->isEmpty()) {
            return 'AVAILABLE';
        }

        // Check if any overlapping booking is CHECKED_IN
        foreach ($overlappingBookings as $booking) {
            if ($booking->status === 'CHECKED_IN') {
                return 'CHECKED_IN';
            }
        }

        // Check if any overlapping booking is PENDING
        foreach ($overlappingBookings as $booking) {
            if ($booking->status === 'PENDING') {
                return 'BOOKED';
            }
        }

        // Default to BOOKED if there are overlapping bookings
        return 'BOOKED';
    }
}


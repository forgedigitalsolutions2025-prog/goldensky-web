<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'booking_id',
        'guest_id',
        'room_number',
        'check_in_time',
        'check_out_time',
        'booked_date',
        'number_of_nights',
        'number_of_adults',
        'number_of_children',
        'advance_payment',
        'status',
        'booking_source',
        'notes',
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
        'booked_date' => 'datetime',
        'number_of_nights' => 'integer',
        'number_of_adults' => 'integer',
        'number_of_children' => 'integer',
        'advance_payment' => 'decimal:2',
    ];

    /**
     * Generate unique booking ID
     */
    public static function generateBookingId(): string
    {
        do {
            $bookingId = 'WEB-' . time() . '-' . rand(1000, 9999);
        } while (self::where('booking_id', $bookingId)->exists());

        return $bookingId;
    }

    /**
     * Check for double booking
     * Overlap occurs if: existing_checkout > requested_checkin AND existing_checkin < requested_checkout
     */
    public static function hasDoubleBooking($roomNumber, $checkIn, $checkOut, $excludeBookingId = null)
    {
        $query = self::where('room_number', $roomNumber)
            ->where('status', '!=', 'CANCELLED')
            ->where(function ($q) use ($checkIn, $checkOut) {
                // Use DATE() to compare only the date part, not the full datetime
                $q->whereRaw('DATE(check_out_time) > ?', [$checkIn])
                  ->whereRaw('DATE(check_in_time) < ?', [$checkOut]);
            });

        if ($excludeBookingId) {
            $query->where('booking_id', '!=', $excludeBookingId);
        }

        return $query->exists();
    }
}


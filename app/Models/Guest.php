<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Guest extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'guests';

    protected $fillable = [
        'guest_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'nationality',
        'passport_number',
    ];

    /**
     * Generate unique guest ID starting from WEB-G-001
     */
    public static function generateGuestId(): string
    {
        // Find the highest existing WEB-G-XXX ID
        $lastGuest = self::where('guest_id', 'like', 'WEB-G-%')
            ->orderByRaw('CAST(SUBSTRING(guest_id, 7) AS UNSIGNED) DESC')
            ->first();
        
        if ($lastGuest) {
            // Extract the number from the last ID (e.g., "WEB-G-001" -> 1)
            $lastNumber = (int) substr($lastGuest->guest_id, 7);
            $nextNumber = $lastNumber + 1;
        } else {
            // No WEB-G-XXX IDs exist, start from 001
            $nextNumber = 1;
        }
        
        // Format as WEB-G-XXX with zero padding (e.g., WEB-G-001, WEB-G-002)
        $guestId = 'WEB-G-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        
        // Double-check it doesn't exist (in case of race condition)
        while (self::where('guest_id', $guestId)->exists()) {
            $nextNumber++;
            $guestId = 'WEB-G-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        }
        
        return $guestId;
    }
    
    /**
     * Route notifications for the guest.
     */
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
}


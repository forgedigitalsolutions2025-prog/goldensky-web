<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'treatment_id',
        'booking_date',
        'booking_time',
        'message',
        'is_couple_package',
        'discount_applied',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'booking_time' => 'datetime',
        'is_couple_package' => 'boolean',
        'discount_applied' => 'decimal:2',
    ];

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
}






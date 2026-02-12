<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'qualifications',
        'specialization',
        'experience',
        'bio',
        'image',
        'years_of_experience',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'years_of_experience' => 'integer',
    ];
}

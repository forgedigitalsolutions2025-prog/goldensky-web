<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $table = 'menu_items';

    protected $fillable = [
        'item_id',
        'name',
        'description',
        'category',
        'price',
        'available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'available' => 'boolean',
    ];

    /**
     * Get available menu items
     */
    public function scopeAvailable($query)
    {
        return $query->where('available', true);
    }

    /**
     * Get items by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}


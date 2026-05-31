<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'address',
        'kelurahan',
        'description',
        'phone',
        'email',
        'owner',
        'logo',
        'status',
    ];

    /**
     * Get the icon class based on category.
     */
    public function getCategoryIconAttribute(): string
    {
        return match($this->category) {
            'Kuliner'   => 'bx-restaurant',
            'Kriya'     => 'bx-brush',
            'Kesehatan' => 'bx-plus-medical',
            'Fashion'   => 'bx-hanger',
            'Pertanian' => 'bx-leaf',
            default     => 'bx-store',
        };
    }

    /**
     * Get the color class based on category.
     */
    public function getCategoryColorAttribute(): string
    {
        return match($this->category) {
            'Kuliner'   => 'text-orange-500 bg-orange-50',
            'Kriya'     => 'text-yellow-600 bg-yellow-50',
            'Kesehatan' => 'text-blue-500 bg-blue-50',
            'Fashion'   => 'text-purple-500 bg-purple-50',
            'Pertanian' => 'text-green-600 bg-green-50',
            default     => 'text-gray-500 bg-gray-50',
        };
    }

    /**
     * Get the badge color class for category text.
     */
    public function getCategoryBadgeAttribute(): string
    {
        return match($this->category) {
            'Kuliner'   => 'text-orange-500',
            'Kriya'     => 'text-yellow-600',
            'Kesehatan' => 'text-blue-500',
            'Fashion'   => 'text-purple-500',
            'Pertanian' => 'text-green-600',
            default     => 'text-gray-500',
        };
    }
}

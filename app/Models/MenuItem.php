<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image_url',
        'available',
        'is_best_seller',
        'is_favorite',
        'is_recommended',
        'is_popular',
    ];

    protected $casts = [
        'price' => 'integer',
        'available' => 'boolean',
        'is_best_seller' => 'boolean',
        'is_favorite' => 'boolean',
        'is_recommended' => 'boolean',
        'is_popular' => 'boolean',
    ];

    /**
     * Scope: hanya menu tersedia
     */
    public function scopeAvailable($query)
    {
        return $query->where('available', true);
    }

    /**
     * Scope: filter by kategori
     */
    public function scopeCategory($query, string $category)
    {
        if ($category && $category !== 'semua') {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * Scope: menu rekomendasi
     */
    public function scopeRecommended($query)
    {
        return $query->where('is_recommended', true);
    }

    /**
     * Scope: menu populer
     */
    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }

    /**
     * Format harga ke Rupiah
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}

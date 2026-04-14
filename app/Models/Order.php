<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'phone',
        'note',
        'total',
        'status',
    ];

    protected $casts = [
        'total' => 'integer',
    ];

    /**
     * Relasi: Order memiliki banyak OrderItem
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Format total ke Rupiah
     */
    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    /**
     * Label status dengan warna
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'diproses' => 'info',
            'selesai' => 'success',
            default => 'secondary',
        };
    }
}

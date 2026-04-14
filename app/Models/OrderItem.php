<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'menu_item_id',
        'name',
        'price',
        'qty',
    ];

    protected $casts = [
        'price' => 'integer',
        'qty' => 'integer',
    ];

    /**
     * Relasi: OrderItem milik Order
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi: OrderItem milik MenuItem
     */
    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }

    /**
     * Subtotal item
     */
    public function getSubtotalAttribute(): int
    {
        return $this->price * $this->qty;
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}

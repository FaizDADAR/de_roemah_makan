<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catering extends Model
{
    protected $fillable = [
        'customer_name',
        'phone',
        'people',
        'date',
        'time',
        'note',
        'status',
    ];

    protected $casts = [
        'people' => 'integer',
        'date' => 'date',
    ];

    public function items()
    {
        return $this->hasMany(CateringItem::class);
    }

    public function getTotalPriceAttribute(): int
    {
        return $this->items->sum(fn ($item) => $item->price * $item->qty);
    }

    /**
     * Label status dengan warna
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'dikonfirmasi' => 'success',
            default => 'secondary',
        };
    }
}

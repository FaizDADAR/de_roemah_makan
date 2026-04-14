<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
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

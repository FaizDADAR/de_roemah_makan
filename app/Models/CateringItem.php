<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CateringItem extends Model
{
    protected $fillable = ['catering_id', 'menu_item_id', 'name', 'price', 'qty'];

    public function catering(): BelongsTo
    {
        return $this->belongsTo(Catering::class);
    }

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }
}

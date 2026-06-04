<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'status',
        'expires_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function isValid()
    {
        if (! $this->status) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return true;
    }

    public function calculateDiscount($subtotal)
    {
        if ($this->type === 'percent') {
            return round(($subtotal * $this->value) / 100, 2);
        }

        return min($this->value, $subtotal);
    }
}

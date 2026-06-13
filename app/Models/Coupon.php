<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Coupon
 *
 * @package App\Models
 * @property int $id
 * @property string $code
 * @property string $type
 * @property float $value
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $expires_at
 */
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

    /**
     * Check if the coupon is valid and not expired.
     *
     * @return bool
     */
    public function isValid(): bool
    {
        if (! $this->status) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Calculate discount amount for a given subtotal.
     *
     * @param float $subtotal
     * @return float
     */
    public function calculateDiscount(float $subtotal): float
    {
        if ($this->type === 'percent') {
            return round(($subtotal * $this->value) / 100, 2);
        }

        return min($this->value, $subtotal);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class OrderItem
 *
 * @package App\Models
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $product_title
 * @property int $quantity
 * @property float $price
 * @property float $total
 * @property-read Order $order
 * @property-read Product $product
 */
class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_title',
        'quantity',
        'price',
        'total',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Product
 *
 * @package App\Models
 * @property int $id
 * @property int $category_id
 * @property int|null $user_id
 * @property string $title
 * @property string|null $keywords
 * @property string|null $detail
 * @property string|null $description
 * @property string|null $image
 * @property float $price
 * @property int $stock
 * @property int $minstock
 * @property int $discount
 * @property bool $status
 * @property-read Category $category
 * @property-read User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection|OrderItem[] $orderItems
 */
class Product extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'keywords',
        'detail',
        'description',
        'image',
        'price',
        'stock',
        'minstock',
        'discount',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'price' => 'decimal:2',
        'discount' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('status', true)->where('stock', '>', 0);
    }

    public function getDiscountedPrice(): float
    {
        if ($this->discount > 0) {
            return round($this->price - ($this->price * $this->discount / 100), 2);
        }

        return $this->price;
    }

    public function hasDiscount(): bool
    {
        return $this->discount > 0;
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }
}

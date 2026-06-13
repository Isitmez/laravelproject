<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category
 *
 * @package App\Models
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string|null $keywords
 * @property string|null $description
 * @property string|null $image
 * @property bool $status
 * @property-read \Illuminate\Database\Eloquent\Collection|Category[] $children
 * @property-read Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $products
 */
class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'title',
        'keywords',
        'description',
        'image',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeParents($query)
    {
        return $query->where('parent_id', 0);
    }
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function isParent(): bool
    {
        return $this->parent_id === 0;
    }
}

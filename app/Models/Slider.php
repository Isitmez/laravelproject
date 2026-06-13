<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Slider
 *
 * @package App\Models
 * @property int $id
 * @property string|null $title
 * @property string|null $subtitle
 * @property string|null $image
 * @property string|null $button_text
 * @property string|null $button_link
 * @property int $sort_order
 * @property bool $status
 */
class Slider extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'button_text',
        'button_link',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('sort_order');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'unit_label',
        'stock',
        'description',
        'image',
        'is_spicy',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_spicy' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'stock' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http://')
            || str_starts_with($this->image, 'https://')
            || str_starts_with($this->image, 'assets/')) {
            return asset($this->image);
        }

        return asset('storage/' . $this->image);
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format((float) $this->price, 2, ',', '.');
    }
}

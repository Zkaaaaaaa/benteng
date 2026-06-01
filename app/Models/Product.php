<?php

namespace App\Models;

use App\Support\PublicStorage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method bool|null delete()
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'unit_label',
        'description',
        'description_en',
        'description_nl',
        'image',
        'is_spicy',
        'sort_order',
        'is_active',
        'is_rames',
        'rames_group',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_spicy' => 'boolean',
            'is_active' => 'boolean',
            'is_rames' => 'boolean',
            'rames_group' => 'string',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::deleting(function (Product $product) {
            PublicStorage::delete($product->image);
        });
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

    public function scopeRames(Builder $query): Builder
    {
        return $query->where('is_rames', true);
    }

    public function scopeRamesGroup(Builder $query, string $group): Builder
    {
        return $query->where('rames_group', $group);
    }

    public function getImageUrlAttribute(): ?string
    {
        return PublicStorage::url($this->image);
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format((float) $this->price, 2, ',', '.');
    }
}

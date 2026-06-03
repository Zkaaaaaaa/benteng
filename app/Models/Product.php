<?php

namespace App\Models;

use App\Models\Concerns\HasStoredMedia;
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
    use HasStoredMedia;

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
        'allergens',
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
            'allergens' => 'array',
            'is_active' => 'boolean',
            'is_rames' => 'boolean',
            'rames_group' => 'string',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::deleting(function (Product $product) {
            $product->deleteStoredMedia($product->image);
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
        return $this->mediaUrl($this->image);
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format((float) $this->price, 2, ',', '.');
    }

    /** @return array<string, array{icon: string, en: string, nl: string}> */
    public static function allergenCatalog(): array
    {
        return [
            'egg' => ['icon' => '🥚', 'en' => 'Egg', 'nl' => 'Ei'],
            'gluten' => ['icon' => '🌾', 'en' => 'Gluten', 'nl' => 'Gluten'],
            'milk' => ['icon' => '🥛', 'en' => 'Milk', 'nl' => 'Melk'],
            'mustard' => ['icon' => '🟡', 'en' => 'Mustard', 'nl' => 'Mosterd'],
            'peanuts' => ['icon' => '🥜', 'en' => 'Peanuts', 'nl' => 'Pinda'],
            'lupine' => ['icon' => '🌿', 'en' => 'Lupine', 'nl' => 'Lupine'],
            'nuts' => ['icon' => '🌰', 'en' => 'Nuts', 'nl' => 'Noten'],
            'crustaceans' => ['icon' => '🦐', 'en' => 'Crustaceans', 'nl' => 'Schaaldieren'],
            'fish' => ['icon' => '🐟', 'en' => 'Fish', 'nl' => 'Vis'],
            'soy' => ['icon' => '🌱', 'en' => 'Soy', 'nl' => 'Soja'],
            'sesame' => ['icon' => '⚪', 'en' => 'Sesame', 'nl' => 'Sesam'],
            'celery' => ['icon' => '🥬', 'en' => 'Celery', 'nl' => 'Selderij'],
            'molluscs' => ['icon' => '🐚', 'en' => 'Molluscs', 'nl' => 'Weekdieren'],
            'sulphites' => ['icon' => '🍷', 'en' => 'Sulphites', 'nl' => 'Sulfiet'],
        ];
    }

    /** @return list<array{key: string, icon: string, label: string}> */
    public function activeAllergenBadges(string $locale = 'en'): array
    {
        $localeKey = $locale === 'nl' ? 'nl' : 'en';
        $flags = $this->allergens ?? [];

        return collect(self::allergenCatalog())
            ->filter(fn (array $meta, string $key) => ! empty($flags[$key]))
            ->map(fn (array $meta, string $key) => [
                'key' => $key,
                'icon' => $meta['icon'],
                'label' => $meta[$localeKey],
            ])
            ->values()
            ->all();
    }
}

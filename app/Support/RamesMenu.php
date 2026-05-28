<?php

namespace App\Support;

use App\Models\RamesItem;
use Illuminate\Support\Collection;

/**
 * Data menu Rames untuk tampilan homepage (3 kolom: basis, vlees_of_vis, groenten).
 */
class RamesMenu
{
    public static function forHomepage(): array
    {
        $items = RamesItem::query()
            ->with(['product' => fn ($q) => $q->active()->ordered()])
            ->get()
            ->filter(fn (RamesItem $item) => $item->product !== null);

        return [
            'basis' => self::productsInSection($items, 'basis'),
            'kip' => self::productsInSubsection($items, 'kip'),
            'vlees' => self::productsInSubsection($items, 'vlees'),
            'vis' => self::productsInSubsection($items, 'vis'),
            'groenten' => self::productsInSection($items, 'groenten'),
        ];
    }

    /** @return Collection<int, \App\Models\Product> */
    private static function productsInSection(Collection $items, string $section): Collection
    {
        return $items
            ->where('section', $section)
            ->map(fn (RamesItem $item) => $item->product)
            ->values();
    }

    /** @return Collection<int, \App\Models\Product> */
    private static function productsInSubsection(Collection $items, string $subsection): Collection
    {
        return $items
            ->where('section', 'vlees_of_vis')
            ->where('subsection', $subsection)
            ->map(fn (RamesItem $item) => $item->product)
            ->values();
    }
}

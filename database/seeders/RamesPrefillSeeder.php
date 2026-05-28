<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\RamesItem;
use App\Models\RamesSetting;
use Illuminate\Database\Seeder;

class RamesPrefillSeeder extends Seeder
{
    public function run(): void
    {
        RamesSetting::query()->firstOrCreate(
            [],
            [
                'title_nl' => 'Onze Rames',
                'title_en' => 'Our Rames',
                'subtitle_nl' => 'Zoals Jij Het Wilt',
                'subtitle_en' => 'Just the Way You Like It',
                'small_title_nl' => 'KLEIN',
                'small_title_en' => 'KLEIN',
                'large_title_nl' => 'GROOT',
                'large_title_en' => 'GROOT',
                'small_price' => 13.75,
                'large_surcharge' => 3.00,
                'small_desc' => '1x vlees of vis, 1x groente & sambal goreng ei',
                'large_desc' => '2x vlees of vis, 2x groente, Tahoe of Tempe & sambal goreng ei',
                'instruction_nl' => 'Kies eerst jouw grootte en kies daarna in 3 simpele stappen de rest van jouw rames.',
                'instruction_en' => 'Choose your size first, then complete your rames in 3 simple steps.',
                'button_label_nl' => 'Bekijk Volledige Menu',
                'button_label_en' => 'View Full Menu',
                'bottom_title_nl' => 'Speciaal (extra optie)',
                'bottom_title_en' => 'Special (extra option)',
                'bottom_text_nl' => '2 stokjes Saté Ayam (kipsaté) +3,- of 2 stokjes Saté Babi (varkenssaté) +3,-',
                'bottom_text_en' => '2 skewers Saté Ayam (chicken satay) +3,- or 2 skewers Saté Babi (pork satay) +3,-',
            ]
        );

        // Mapping sekali dari slug kategori menu (data awal), bukan dipakai runtime.
        $slugToRames = [
            'rames-klein' => ['section' => 'basis', 'subsection' => null],
            'kip' => ['section' => 'vlees_of_vis', 'subsection' => 'kip'],
            'vlees' => ['section' => 'vlees_of_vis', 'subsection' => 'vlees'],
            'vis' => ['section' => 'vlees_of_vis', 'subsection' => 'vis'],
            'groente' => ['section' => 'groenten', 'subsection' => null],
        ];

        RamesItem::query()->delete();

        foreach (Category::query()->whereIn('slug', array_keys($slugToRames))->get(['id', 'slug']) as $category) {
            $map = $slugToRames[$category->slug] ?? null;
            if (! $map) {
                continue;
            }

            Product::query()
                ->where('category_id', $category->id)
                ->each(function (Product $product) use ($map) {
                    RamesItem::query()->create([
                        'product_id' => $product->id,
                        'section' => $map['section'],
                        'subsection' => $map['subsection'],
                    ]);
                });
        }
    }
}

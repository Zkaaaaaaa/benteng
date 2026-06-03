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
                'small_title_nl' => 'BENTENG RAMES',
                'small_title_en' => 'BENTENG RAMES',
                'large_title_nl' => 'SPECIAAL',
                'large_title_en' => 'SPECIAAL',
                'small_price' => 12.95,
                'large_surcharge' => 1.55,
                'small_desc' => 'Kies een basisgerecht, kies 1 vlees- of kipgerecht, kies 2 groentegerechten, inclusief ei',
                'large_desc' => 'Kies een basisgerecht, kies 2 vlees- of kipgerechten, kies 2 groentegerechten, inclusief ei',
                'instruction_nl' => 'Kies eerst jouw grootte en kies daarna in 3 simpele stappen de rest van jouw rames.',
                'instruction_en' => 'Choose your size first, then complete your rames in 3 simple steps.',
                'button_label_nl' => 'Bekijk Volledige Menu',
                'button_label_en' => 'View Full Menu',
                'bottom_title_nl' => 'Vegetarisch',
                'bottom_title_en' => 'Vegetarian',
                'bottom_text_nl' => 'Kies een basisgerecht, kies 4 groentegerechten of 3 groentegerechten plus ei',
                'bottom_text_en' => 'Choose a basic dish, choose 4 vegetable dishes or 3 vegetable dishes plus egg',
            ]
        );

        // Mapping sekali dari slug kategori menu (data awal), bukan dipakai runtime.
        $slugToRames = [
            'basisgerechten' => ['section' => 'basis', 'subsection' => null],
            'kipgerechten' => ['section' => 'vlees_of_vis', 'subsection' => 'kip'],
            'rundvleesgerechten' => ['section' => 'vlees_of_vis', 'subsection' => 'vlees'],
            'visgerechten' => ['section' => 'vlees_of_vis', 'subsection' => 'vis'],
            'groentegerechten' => ['section' => 'groenten', 'subsection' => null],
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

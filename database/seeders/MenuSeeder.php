<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Product::query()->delete();
        Category::query()->delete();

        $menu = [
            [
                'name' => 'Basisgerechten',
                'slug' => 'basisgerechten',
                'sort_order' => 1,
                'show_on_home' => false,
                'products' => [
                    ['name' => 'Nasi Putih', 'allergens' => []],
                    ['name' => 'Nasi Goreng', 'allergens' => ['crustaceans']],
                    ['name' => 'Nasi Kuning', 'allergens' => ['crustaceans']],
                    ['name' => 'Bami Goreng', 'allergens' => ['gluten', 'crustaceans']],
                    ['name' => 'Mihoen Goreng', 'allergens' => ['gluten', 'crustaceans', 'soy']],
                ],
            ],
            [
                'name' => 'Rundvleesgerechten',
                'slug' => 'rundvleesgerechten',
                'sort_order' => 2,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Smoor', 'allergens' => ['gluten']],
                    ['name' => 'Rendang', 'allergens' => []],
                    ['name' => 'Blado', 'allergens' => [], 'is_spicy' => true],
                ],
            ],
            [
                'name' => 'Kipgerechten',
                'slug' => 'kipgerechten',
                'image' => 'assets/img/kip-cashew.jpg',
                'sort_order' => 3,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Ayam Kecap', 'allergens' => ['gluten', 'soy']],
                    ['name' => 'Ayam Kerrie', 'allergens' => ['soy']],
                    ['name' => 'Ayam Pedes', 'allergens' => ['crustaceans'], 'is_spicy' => true],
                    ['name' => 'Ayam Asem Manis', 'allergens' => ['gluten']],
                    ['name' => 'Sate Ayam', 'allergens' => ['gluten', 'soy']],
                ],
            ],
            [
                'name' => 'Visgerechten',
                'slug' => 'visgerechten',
                'image' => 'assets/img/vis.jpg',
                'sort_order' => 4,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Ikan Bali', 'allergens' => ['fish'], 'is_spicy' => true],
                ],
            ],
            [
                'name' => 'Groentegerechten',
                'slug' => 'groentegerechten',
                'image' => 'assets/img/Sayoer-Lodeh.jpg',
                'sort_order' => 5,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Sayur Lodeh', 'allergens' => ['soy']],
                    ['name' => 'Sayur Boontjes', 'allergens' => ['crustaceans']],
                    ['name' => 'Asinan', 'allergens' => ['lupine']],
                    ['name' => 'Oerap', 'allergens' => []],
                    ['name' => 'Tumis Broccoli', 'allergens' => ['soy']],
                    ['name' => 'Tumis Tauge', 'allergens' => ['soy']],
                    ['name' => 'Tumis Kousenband', 'allergens' => ['gluten', 'soy']],
                    ['name' => 'Tempe Pete', 'allergens' => ['soy']],
                    ['name' => 'Terong Blado', 'allergens' => ['gluten'], 'is_spicy' => true],
                    ['name' => 'Paksoi', 'allergens' => ['soy']],
                    ['name' => 'Telor Pedes', 'allergens' => ['egg'], 'is_spicy' => true],
                    ['name' => 'Gado-Gado', 'allergens' => ['egg', 'soy']],
                    ['name' => 'Sate Tofu', 'allergens' => ['crustaceans', 'soy']],
                ],
            ],
            [
                'name' => 'Toebehoren',
                'slug' => 'toebehoren',
                'sort_order' => 6,
                'show_on_home' => false,
                'products' => [
                    ['name' => 'Kroepoek', 'allergens' => ['gluten'], 'price' => 2.75, 'unit_label' => null],
                    ['name' => 'Spekkoek', 'allergens' => ['gluten', 'milk'], 'price' => 3.25, 'unit_label' => null],
                    ['name' => 'Lemper', 'allergens' => [], 'price' => 3.35, 'unit_label' => null],
                    ['name' => 'Loempia', 'allergens' => ['gluten'], 'price' => 3.35, 'unit_label' => null],
                ],
            ],
        ];

        foreach ($menu as $sort => $categoryData) {
            $products = $categoryData['products'];
            unset($categoryData['products']);

            $category = Category::create([
                ...$categoryData,
                'sort_order' => $categoryData['sort_order'] ?? ($sort + 1),
            ]);

            foreach ($products as $productSort => $productData) {
                Product::create([
                    'category_id' => $category->id,
                    'name'        => $productData['name'],
                    'slug'        => Str::slug($productData['name']) . '-' . $category->slug,
                    'description' => $productData['description'] ?? null,
                    'price'       => $productData['price'] ?? 3.50,
                    'unit_label'  => array_key_exists('unit_label', $productData)
                        ? $productData['unit_label']
                        : '/ 100 gr.',
                    'is_spicy'    => $productData['is_spicy'] ?? false,
                    'allergens'   => $this->allergens($productData['allergens'] ?? []),
                    'sort_order'  => $productSort + 1,
                    'is_active'   => true,
                ]);
            }
        }
    }

    /** @param  list<string>  $active */
    private function allergens(array $active): array
    {
        $keys = [
            'egg', 'gluten', 'milk', 'mustard', 'peanuts', 'lupine', 'nuts',
            'crustaceans', 'fish', 'soy', 'sesame', 'celery', 'molluscs', 'sulphites',
        ];

        $activeLookup = array_fill_keys($active, true);

        return collect($keys)
            ->mapWithKeys(fn (string $key) => [$key => isset($activeLookup[$key])])
            ->all();
    }
}

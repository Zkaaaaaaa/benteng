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
                    ['name' => 'Nasi Putih', 'allergens' => [], 'price' => 2.95],
                    ['name' => 'Nasi Goreng', 'allergens' => ['crustaceans', 'fish'], 'price' => 4.25],
                    ['name' => 'Nasi Kuning', 'allergens' => [], 'price' => 4.25],
                    ['name' => 'Bami Goreng', 'allergens' => ['gluten', 'crustaceans', 'egg', 'fish', 'soy'], 'price' => 4.25],
                    ['name' => 'Mihoen Goreng', 'allergens' => ['gluten', 'crustaceans', 'fish', 'soy'], 'price' => 4.25],
                ],
            ],
            [
                'name' => 'Rundvleesgerechten',
                'slug' => 'rundvleesgerechten',
                'sort_order' => 2,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Smoor', 'allergens' => ['gluten', 'soy'], 'price' => 3.25],
                    ['name' => 'Rendang', 'allergens' => [], 'is_spicy' => true, 'price' => 3.25],
                    ['name' => 'Blado', 'allergens' => ['crustaceans'], 'is_spicy' => true, 'price' => 3.25],
                ],
            ],
            [
                'name' => 'Kipgerechten',
                'slug' => 'kipgerechten',
                'image' => 'assets/img/kip-cashew.jpg',
                'sort_order' => 3,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Ayam Kecap', 'allergens' => ['gluten', 'egg', 'soy'], 'price' => 3.00],
                    ['name' => 'Ayam Kerrie', 'allergens' => [], 'price' => 3.00],
                    ['name' => 'Ayam Pedes', 'allergens' => ['crustaceans'], 'is_spicy' => true, 'price' => 3.00],
                    ['name' => 'Ayam Asem Manis', 'allergens' => ['gluten'], 'price' => 3.00],
                    ['name' => 'Sate Ayam', 'allergens' => ['gluten', 'soy'], 'price' => 7.50],
                ],
            ],
            [
                'name' => 'Visgerechten',
                'slug' => 'visgerechten',
                'image' => 'assets/img/vis.jpg',
                'sort_order' => 4,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Ikan Bali', 'allergens' => ['fish'], 'is_spicy' => true, 'price' => 4.35],
                ],
            ],
            [
                'name' => 'Groentegerechten',
                'slug' => 'groentegerechten',
                'image' => 'assets/img/Sayoer-Lodeh.jpg',
                'sort_order' => 5,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Sayur Lodeh', 'allergens' => [], 'price' => 2.30],
                    ['name' => 'Sayur Boontjes', 'allergens' => ['crustaceans'], 'price' => 2.30],
                    ['name' => 'Asinan', 'allergens' => ['peanuts'], 'price' => 2.30],
                    ['name' => 'Oerap', 'allergens' => [], 'price' => 2.30],
                    ['name' => 'Tumis Broccoli', 'allergens' => ['fish'], 'price' => 2.30],
                    ['name' => 'Tumis Tauge', 'allergens' => ['fish'], 'price' => 2.30],
                    ['name' => 'Tumis Kousenband', 'allergens' => ['gluten', 'fish', 'soy'], 'price' => 2.30],
                    ['name' => 'Tempe Pete', 'allergens' => ['crustaceans', 'soy'], 'price' => 2.75],
                    ['name' => 'Terong Blado', 'allergens' => ['crustaceans'], 'is_spicy' => true, 'price' => 2.75],
                    ['name' => 'Paksoi', 'allergens' => ['fish'], 'price' => 2.30],
                    ['name' => 'Telor Pedes', 'allergens' => ['egg', 'crustaceans'], 'is_spicy' => true, 'price' => 1.45],
                    ['name' => 'Gado-Gado', 'allergens' => ['egg', 'soy'], 'price' => 8.50],
                    ['name' => 'Sate Tofu', 'allergens' => [], 'price' => 4.50],
                ],
            ],
            [
                'name' => 'Toebehoren',
                'slug' => 'toebehoren',
                'sort_order' => 6,
                'show_on_home' => false,
                'products' => [
                    ['name' => 'Kroepoek', 'allergens' => [], 'price' => 2.75],
                    ['name' => 'Spekkoek', 'allergens' => ['egg', 'gluten', 'milk'], 'price' => 2.95],
                    ['name' => 'Lemper', 'allergens' => [], 'price' => 2.95],
                    ['name' => 'Loempia', 'allergens' => ['gluten'], 'price' => 2.95],
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
                    'name' => $productData['name'],
                    'slug' => Str::slug($productData['name']).'-'.$category->slug,
                    'description' => $productData['description'] ?? null,
                    'price' => $productData['price'] ?? 3.50,
                    'unit_label' => array_key_exists('unit_label', $productData)
                        ? $productData['unit_label']
                        : '/ 100 gr.',
                    'is_spicy' => $productData['is_spicy'] ?? false,
                    'allergens' => $this->allergens($productData['allergens'] ?? []),
                    'sort_order' => $productSort + 1,
                    'is_active' => true,
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

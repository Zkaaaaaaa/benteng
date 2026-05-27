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
                'name' => 'Rames klein',
                'slug' => 'rames-klein',
                'subtitle' => '1x vlees of vis, 1x groente & sambal goreng ei',
                'sort_order' => 1,
                'show_on_home' => false,
                'products' => [
                    ['name' => 'Nasi Putih', 'description' => 'Witte rijst', 'price' => 13.75],
                    ['name' => 'Longtong Rames', 'description' => 'Blokjes kleefrijst', 'price' => 13.75],
                    ['name' => 'Nasi Koening', 'description' => 'Gele rijst in kokos', 'price' => 13.75],
                    ['name' => 'Nasi Goreng', 'description' => 'Gebakken rijst', 'price' => 13.75],
                    ['name' => 'Nasi Djawa', 'description' => 'Pittig gebakken rijst', 'price' => 13.75, 'is_spicy' => true],
                    ['name' => 'Bami', 'description' => 'Bami', 'price' => 13.75],
                ],
            ],
            [
                'name' => 'Rames normaal',
                'slug' => 'rames-normaal',
                'subtitle' => '2x vlees of vis, 2x groente, Tahoe of Tempe & sambal goreng ei',
                'sort_order' => 2,
                'show_on_home' => false,
                'products' => [
                    ['name' => 'Nasi Putih', 'description' => 'Witte rijst', 'price' => 16.75],
                    ['name' => 'Longtong Rames', 'description' => 'Blokjes kleefrijst', 'price' => 16.75],
                    ['name' => 'Nasi Koening', 'description' => 'Gele rijst in kokos', 'price' => 16.75],
                    ['name' => 'Nasi Goreng', 'description' => 'Gebakken rijst', 'price' => 16.75],
                    ['name' => 'Nasi Djawa', 'description' => 'Pittig gebakken rijst', 'price' => 16.75, 'is_spicy' => true],
                    ['name' => 'Bami', 'description' => 'Bami', 'price' => 16.75],
                ],
            ],
            [
                'name' => 'Gado gado of sate menu',
                'slug' => 'gado-gado-of-sate-menu',
                'sort_order' => 3,
                'show_on_home' => false,
                'products' => [
                    ['name' => 'Sate Babi Menu', 'description' => '3 stokjes saté, atjar ketimoen, gebakken uitjes en kroepoek. Kies witte rijst, nasi goreng of bami', 'price' => 10.50],
                    ['name' => 'Sate Ayam Menu', 'description' => '3 stokjes saté, atjar ketimoen, gebakken uitjes en kroepoek. Kies witte rijst, nasi goreng of bami', 'price' => 9.50],
                    ['name' => 'Gado Gado menu', 'description' => 'Gestoomde groenten met tahoe, tempe, komkommer, een gekookt eitje en pindasaus met citroengras en limoenblaadjes. Extra lontong of witte rijst + €1,50', 'price' => 9.50],
                ],
            ],
            [
                'name' => 'Kip',
                'slug' => 'kip',
                'image' => 'assets/img/kip-cashew.jpg',
                'sort_order' => 4,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Ayam Klateng', 'description' => 'Geroosterde kippedijen in een marinade van kokos, limoenblad en limoengras', 'price' => 3.50, 'unit_label' => '/ 100 gr.'],
                    ['name' => 'Ayam Cashew', 'description' => 'Krokant gebakken kipfilet gemarineerd in zoete saus', 'price' => 3.50, 'unit_label' => '/ 100 gr.'],
                    ['name' => 'Ayam Panggang Ketjap', 'description' => 'Gegrilde kip gemarineerd in zoete pittige sojasaus', 'price' => 3.50, 'unit_label' => '/ 100 gr.'],
                ],
            ],
            [
                'name' => 'Vlees',
                'slug' => 'vlees',
                'image' => 'assets/img/vlees.jpg',
                'sort_order' => 5,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Daging Semoor', 'description' => 'Rundvlees gesmoord in zoete sojasaus', 'price' => 3.50, 'unit_label' => '/ 100 gr.'],
                    ['name' => 'Daging blado', 'description' => 'Pittig gekruid rundvlees', 'price' => 3.50, 'unit_label' => '/ 100 gr.', 'is_spicy' => true],
                    ['name' => 'Rendang padang', 'description' => 'Rundvlees gesmoord in kokos', 'price' => 3.50, 'unit_label' => '/ 100 gr.'],
                    ['name' => 'Sambal goreng kalkun peteh', 'description' => 'Pittig gekruid kalkoenfilet met petehbonen', 'price' => 3.50, 'unit_label' => '/ 100 gr.'],
                    ['name' => 'Babi Ketjap', 'description' => 'Varkenshaas gesmoord in zoete sojasaus', 'price' => 2.95, 'unit_label' => '/ 100 gr.'],
                ],
            ],
            [
                'name' => 'Vis',
                'slug' => 'vis',
                'image' => 'assets/img/vis.jpg',
                'sort_order' => 6,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Sambal Goreng Oedang', 'description' => 'Garnalen met petehbonen', 'price' => 4.25, 'unit_label' => '/ 100 gr.'],
                    ['name' => 'Ikan Bali', 'description' => 'Gebakken makreel met pikante marinade', 'price' => 4.00, 'unit_label' => '/ 100 gr.', 'is_spicy' => true],
                ],
            ],
            [
                'name' => 'Groente',
                'slug' => 'groente',
                'image' => 'assets/img/Sayoer-Lodeh.jpg',
                'sort_order' => 7,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Sambal Goreng Boontjes', 'description' => 'Pittig gekruide boontjes met tahoe en petehbonen', 'price' => 2.50, 'unit_label' => '/ 100 gr.'],
                    ['name' => 'Sambal Goreng Boontjes Pedis', 'description' => 'Pittig gekruide boontjes met tahoe en petehbonen', 'price' => 3.50, 'unit_label' => '/ 100 gr.', 'is_spicy' => true],
                    ['name' => 'Katjang Panjang Tempé', 'description' => 'Roergebakken kousenband met tempe en tomaat', 'price' => 3.50, 'unit_label' => '/ 100 gr.'],
                    ['name' => 'Orak Arek', 'description' => 'Roergebakken groenten met gepocheerd ei', 'price' => 3.50, 'unit_label' => '/ 100 gr.'],
                    ['name' => 'Sajoer Lodeh', 'description' => 'Gestoomde groenten in kokossaus', 'price' => 3.50, 'unit_label' => '/ 100 gr.'],
                    ['name' => 'Terong Blado', 'description' => 'Pittige aubergine met lombok', 'price' => 3.50, 'unit_label' => '/ 100 gr.', 'is_spicy' => true],
                    ['name' => 'Atjar Ketimoen', 'description' => 'Komkommer in zoetzure saus', 'price' => 2.75, 'unit_label' => '/ 100 gr.'],
                ],
            ],
            [
                'name' => 'Vegetarisch',
                'slug' => 'vegetarisch',
                'image' => 'assets/img/vegetarisch.jpg',
                'sort_order' => 8,
                'show_on_home' => true,
                'products' => [
                    ['name' => 'Tahoe Oblok', 'description' => 'Tofu met petehbonen in kokossaus', 'price' => 3.00, 'unit_label' => '/ 100 gr.'],
                    ['name' => 'Tempé Peteh', 'description' => 'Sojakoek met petehbonen', 'price' => 3.00, 'unit_label' => '/ 100 gr.'],
                    ['name' => 'Sambal Goreng Telor', 'description' => 'Gekookt eitje in kokossaus', 'price' => 1.75],
                    ['name' => 'Telor Blado', 'description' => 'Pittig gekookt eitje', 'price' => 1.75, 'is_spicy' => true],
                ],
            ],
            [
                'name' => 'Soep',
                'slug' => 'soep',
                'sort_order' => 9,
                'show_on_home' => false,
                'products' => [
                    ['name' => 'Soto Ayam Taugé', 'description' => "Oma's bouillon soep rijkelijk gevuld met kip, tauge en een gekookt eitje", 'price' => 8.00],
                ],
            ],
            [
                'name' => 'Hartige snacks',
                'slug' => 'hartige-snacks',
                'sort_order' => 10,
                'show_on_home' => false,
                'products' => [
                    ['name' => 'Batjang (Op bestelling)', 'description' => 'Kleefrijst verpakt in bamboebladeren, gevuld met zoet gekruide rund / varken of kip', 'price' => 5.00],
                    ['name' => 'Loempia Semarang (Op bestelling)', 'description' => 'Gevuld met bamboeshoots en kip', 'price' => 3.35],
                    ['name' => 'Bapao', 'description' => 'Broodjes gevuld met kip of rund', 'price' => 3.35],
                    ['name' => 'Lemper', 'description' => 'Kleefrijst gevuld met gesmoorde kip in kokos', 'price' => 3.35],
                    ['name' => 'Indische Kroket van Aardappel', 'description' => 'Gevuld met gekruid rundergehakt', 'price' => 3.35],
                    ['name' => 'Pastei kip', 'description' => 'Gevuld met kip en ei', 'price' => 3.35],
                    ['name' => 'Risolles kip', 'description' => 'Flensje gevuld met kipragout', 'price' => 3.35],
                ],
            ],
            [
                'name' => 'Zoete snacks',
                'slug' => 'zoete-snacks',
                'sort_order' => 11,
                'show_on_home' => false,
                'products' => [
                    ['name' => 'Lapis (op bestelling)', 'description' => 'Geleipudding met rozensmaak', 'price' => 3.25],
                    ['name' => 'Spekkoek naturel of pandan', 'description' => 'Gelaagde Indische cake met kardemon', 'price' => 3.25],
                ],
            ],
            [
                'name' => 'Dranken',
                'slug' => 'dranken',
                'sort_order' => 12,
                'show_on_home' => false,
                'products' => [
                    ['name' => 'Coca Cola, Coca Cola light, Coca Cola Zero', 'price' => 2.95],
                    ['name' => 'Fanta', 'price' => 2.95],
                    ['name' => 'Bitter Lemon', 'price' => 2.95],
                    ['name' => 'Tonic', 'price' => 2.95],
                    ['name' => 'Fernandes (groen, blauw, rood, geel)', 'price' => 2.95],
                    ['name' => 'Ice Tea Green, Ice Tea Sparkling', 'price' => 2.95],
                    ['name' => 'Kokos water', 'price' => 2.95],
                    ['name' => 'Kokos Roasted Juice', 'price' => 2.95],
                    ['name' => 'Mango Juice', 'price' => 2.95],
                    ['name' => 'Lychee Juice', 'price' => 2.95],
                    ['name' => 'Bintang Bier', 'price' => 3.95],
                    ['name' => 'Ginger Beer', 'price' => 2.95],
                    ['name' => 'Spa (blauw of rood)', 'price' => 2.95],
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
                    'slug' => Str::slug($productData['name']) . '-' . $category->slug,
                    'description' => $productData['description'] ?? null,
                    'price' => $productData['price'],
                    'unit_label' => $productData['unit_label'] ?? null,
                    'is_spicy' => $productData['is_spicy'] ?? false,
                    'sort_order' => $productSort + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}

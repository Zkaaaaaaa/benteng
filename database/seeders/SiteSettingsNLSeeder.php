<?php

namespace Database\Seeders;

use App\Models\SiteSettingNL;
use Illuminate\Database\Seeder;

class SiteSettingsNLSeeder extends Seeder
{
    public function run(): void
    {
        SiteSettingNL::create([
            'title1' => 'Selamat Datang NL',
            'desc1' => 'Ontdek de Lekkerste Indonesische Toko in Amsterdam',
            'img1' => 'assets/images/sayur.png',

            'title2' => 'Het Verhaal van de Lekkerste Toko in Amsterdam',
            'desc2' => 'Sinds jaar en dag brengt Benteng Indonesische Delicatessen de authentieke smaken van Indonesië naar
                Amsterdam. Met traditionele familierecepten, verse en HALAL ingrediënten en geliefde klassiekers zoals
                rendang en sate ayam is Benteng uitgegroeid tot een vertrouwde naam binnen de Indonesische eetcultuur
                van de stad.',
            'img2' => 'assets/images/resto.png',

            'store_name1' => 'Benteng Amsterdam Oud-Zuid',
            'store_name2' => 'Benteng Amsterdam Zuid',

            'address1' => 'Alexander Boersstraat 31 HS, 1071 KV Amsterdam',
            'address2' => 'Stadionweg 49, 1077 RX Amsterdam',

            'lat_coordinate1' => 52.3435,
            'lon_coordinate1' => 4.8910,
            
            'lat_coordinate2' => 52.3491,
            'lon_coordinate2' => 4.8752,
            
            'img_store1' => 'assets/images/banteng.png',
            'img_store2' => 'assets/images/banteng.png',
            
            'phone1' => '+31 20 123 4567',
            'phone2' => '+31 88 227 4145',
            
            'store_link1' => 'https://order.bentengdelicatessen.nl/?loc=1',
            'store_link2' => 'https://order.bentengdelicatessen.nl/?loc=2',
            
            'email' => 'info@bentengdelicatessen.nl',
            'phone' => '+31 20 123 4567',
            'address' => 'Amsterdam, Netherlands',
            
            'title' => 'OPENINGSTIJDEN',
            'opening_hour' => 'Mo–Fr 09:00–22:00',
            
            'logo' => 'assets/images/logo.png',
        ]);
    }
}

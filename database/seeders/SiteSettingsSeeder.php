<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::create([
            'title1' => 'Welcome',
            'desc1' => 'Discover the Finest Indonesian Delicatessen in Amsterdam',
            'img1' => 'assets/images/sayur.png',

            'title2' => 'The Story Behind Amsterdam’s Finest Indonesian Delicatessen',
            'desc2' => 'For many years, Benteng Indonesian Delicatessen has been bringing the authentic flavors of Indonesia to Amsterdam. With traditional family recipes, fresh HALAL ingredients, and beloved classics such as rendang and chicken satay, Benteng has become a trusted name in the city’s Indonesian culinary scene.',
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

            'title' => 'OPENING HOUR',
            'opening_hour' => 'Mon–Fri 09:00–22:00',

            'logo' => 'assets/images/logo.png',
        ]);
    }
}

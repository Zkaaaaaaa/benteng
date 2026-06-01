<?php

namespace Database\Seeders;

use App\Models\GalleryPhoto;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        if (GalleryPhoto::query()->exists()) {
            return;
        }

        $photos = [
            ['name' => 'Indonesische specialiteiten', 'path' => 'assets/images/logo2.jpg'],
            ['name' => 'Benteng delicatessen', 'path' => 'assets/images/logo.png'],
            ['name' => 'Verse ingrediënten', 'path' => 'assets/images/logo2.jpg'],
            ['name' => 'Onze keuken', 'path' => 'assets/images/logo.png'],
        ];

        foreach ($photos as $photo) {
            GalleryPhoto::query()->create($photo);
        }
    }
}

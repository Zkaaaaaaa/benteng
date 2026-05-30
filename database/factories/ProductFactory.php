<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'category_id'    => Category::factory(),
            'name'           => $name,
            'slug'           => Str::slug($name) . '-test',
            'price'          => $this->faker->randomFloat(2, 2, 25),
            'description_en' => $this->faker->sentence(),
            'description_nl' => $this->faker->sentence(),
            'description'    => $this->faker->sentence(),
            'is_active'      => true,
            'sort_order'     => $this->faker->numberBetween(1, 20),
        ];
    }
}
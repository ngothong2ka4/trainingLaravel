<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        return [
            'image' => $faker->imageUrl(),
            'name' => $faker->name,
            'category_id' => random_int(1, 2),
            'price' => $faker->randomFloat(2, 10, 100),
            'description' => $faker->paragraph,
            'sold' => random_int(0, 100),
            'status' => random_int(0,1),
        ];
    }
}

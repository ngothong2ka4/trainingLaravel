<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'name' =>  $faker->text(),
            'slug' => Str::slug($faker->sentence(3)), // Tạo một slug từ một câu ngẫu nhiên gồm 3 từ
            'created_by' => $faker->randomElement(['Super Admin', 'Administrator'])
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 5),
            'status_id' => $this->faker->numberBetween(1, 4),
            'price' => $this->faker->randomFloat(2, 20, 1000)
        ];
    }
}

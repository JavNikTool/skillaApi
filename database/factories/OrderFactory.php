<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderType;
use App\Models\Partnership;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->text(),
            'date' => fake()->date(),
            'address' => fake()->address(),
            'amount' => fake()->randomFloat(2, 0, 1000),
            'status' => fake()->randomElement(['Создан', 'назначен исполнитель', 'завершен']),
            'user_id' => User::query()
                ->inRandomOrder()
                ->first()
                ->id,
            'partnership_id' => Partnership::query()
                ->inRandomOrder()
                ->first()
                ->id,
            'order_type_id' => OrderType::query()
                ->inRandomOrder()
                ->first()
                ->id,
        ];
    }
}

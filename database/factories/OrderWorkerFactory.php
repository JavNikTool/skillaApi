<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderWorker;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderWorker>
 */
class OrderWorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::query()
                ->inRandomOrder()
                ->first()
                ->id,
            'worker_id' => Worker::query()
                ->inRandomOrder()
                ->first()
                ->id,
            'amount' => fake()->randomFloat(2, 0, 1000),
        ];
    }
}

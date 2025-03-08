<?php

namespace Database\Factories;

use App\Models\Partnership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Partnership>
 */
class PartnershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
        ];
    }
}

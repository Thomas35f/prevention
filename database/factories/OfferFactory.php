<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Model>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->numberBetween(3,1000),
            'name' => fake()->unique()->name(),
            'price' => fake()->unique()->randomFloat(2, 1, 15),
            'description' => fake()->realTextBetween(1, 25)
        ];
    }
}

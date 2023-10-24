<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Grid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Grid>
 */
class GridFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'name' => fake()->unique()->word(),
            'client_id' => Client::factory()
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Center;
use App\Models\Offer;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @extends Factory<Model>
 */
class TrainingFactory extends Factory
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
            'name' => fake()->word(),
            'seance_code' => fake()->unique()->numberBetween(1, 1000),
            'offer_id' => Offer::factory(),
            'center_id' => Center::factory(),
            'date' => fake()->date(),
            'trainer_id' => Trainer::factory(),
        ];
    }
}

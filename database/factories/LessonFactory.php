<?php

namespace Database\Factories;


use App\Models\Learner;
use App\Models\Training;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @extends Factory<Model>
 */
class LessonFactory extends Factory
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
            'observation' => fake()->realTextBetween(1, 15),
            'training_id' => Training::factory(),
            'learner_id' => Learner::factory()
        ];
    }
}

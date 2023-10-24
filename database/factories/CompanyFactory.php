<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Model>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->company(),
            'contact' => fake()->userName(),
            'address_line_1' => fake()->streetAddress(),
            'address_line_2'=> fake()->streetAddress(),
            'zip_code' => fake()->randomNumber(5),
            'town' => fake()->city()
        ];
    }
}

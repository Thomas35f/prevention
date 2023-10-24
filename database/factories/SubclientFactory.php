<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Company;
use App\Models\Subclient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Subclient>
 */
class SubclientFactory extends Factory
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
            'company_id' => Company::factory(),
            'client_id' => Client::factory(),
        ];
    }
}

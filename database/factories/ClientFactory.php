<?php

namespace Database\Factories;

use App\Models\Center;
use App\Models\Client;
use App\Models\Company;
use App\Models\Grid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
        ];
    }
}

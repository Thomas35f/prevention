<?php

namespace Database\Seeders;

use App\Models\Center;
use App\Models\Client;
use App\Models\Grid;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = Client::factory()->create();

        Trainer::factory()->create(['user_id' => User::factory()->create(['client_id' => $client->id])->id]);

        Center::factory(2)->create(['client_id' => $client->id]);

        Grid::factory(2)->create(['client_id' => $client->id]);
    }
}

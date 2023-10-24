<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class VehicleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the store method of the VehicleController.
     *
     * @return void
     */
    public function test_store_vehicle()
    {

        Artisan::call('create:roles');

        $trainer = User::factory()->create();
        $this->actingAs($trainer);

        $vehicleData = [
            "name" => "My Car",
            "brand" => "Toyota",
            "license_plate" => "1234 ABC",
            "type" => "Car"
        ];

        $response = $this->json('POST', '/api/vehicles/store', $vehicleData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'vehicle' => [
                    'name',
                    'brand',
                    'license_plate',
                    'type',
                    'learner_id'
                ],
            ])
            ->assertJson([
                'vehicle' => [
                    'name' => "My Car",
                    'brand' => "Toyota",
                    'license_plate' => "1234 ABC",
                    'type' => "Car"
                ]
            ]);
    }
}

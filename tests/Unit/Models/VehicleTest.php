<?php

namespace Tests\Unit\Models;

use App\Models\Learner;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fillable attributes.
     *
     * @return void
     */
    public function test_fillable_attributes(): void
    {
        $vehicle = new Vehicle([
            'name' => 'Car',
            'brand' => 'Toyota',
            'license_plate' => '123ABC',
            'type' => 'Sedan',
            'learner_id' => 1,
        ]);

        $this->assertEquals('Car', $vehicle->name);
        $this->assertEquals('Toyota', $vehicle->brand);
        $this->assertEquals('123ABC', $vehicle->license_plate);
        $this->assertEquals('Sedan', $vehicle->type);
        $this->assertEquals(1, $vehicle->learner_id);
    }

    /**
     * Test learner relation.
     *
     * @return void
     */
    public function test_learner_relation(): void
    {
        $user = User::factory()->create();
        $learner = Learner::factory()->create(['user_id' => $user->id]);
        $vehicle = Vehicle::factory()->create(['learner_id' => $learner->id]);

        $this->assertInstanceOf(Learner::class, $vehicle->learner);
        $this->assertEquals($learner->id, $vehicle->learner->id);
    }

}

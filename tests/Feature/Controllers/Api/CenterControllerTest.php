<?php

namespace Tests\Feature\Controllers\Api;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Center;

class CenterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_centers_for_current_user(): void
    {
        $user = User::factory()->create();

        $center1 = Center::factory()->create(['client_id' => $user->client_id]);
        $center2 = Center::factory()->create(['client_id' => $user->client_id]);

        $this->actingAs($user);

        $response = $this->getJson('/api/getCenters');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $center1->id,
            ])
            ->assertJsonFragment([
                'id' => $center2->id,
            ]);

    }
}


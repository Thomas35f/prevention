<?php

namespace Tests\Feature\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Grid;

class GridControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_grids_for_current_user(): void
    {
        $user = User::factory()->create();

        $grid1 = Grid::factory()->create(['client_id' => $user->client_id]);
        $grid2 = Grid::factory()->create(['client_id' => $user->client_id]);

        $this->actingAs($user);

        $response = $this->getJson('/api/getGrids');

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $grid1->id])
            ->assertJsonFragment(['id' => $grid2->id]);
    }
}


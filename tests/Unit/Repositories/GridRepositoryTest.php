<?php

namespace Tests\Unit\Repositories;

use App\Repositories\GridRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Repositories\LearnerRepository;
use App\Models\Client;
use App\Models\Grid;
use Illuminate\Support\Collection;

class GridRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the getGridsByClientId method of GridRepository.
     *
     * @return void
     */
    public function testGetGridsByClientId()
    {
        $client = Client::factory()->create();

        $grid1 = Grid::factory()->create(['client_id' => $client->id]);
        $grid2 = Grid::factory()->create(['client_id' => $client->id]);
        $grid3 = Grid::factory()->create(['client_id' => $client->id]);

        $gridRepository = new GridRepository(new Grid());

        $grids = $gridRepository->getGridsByClientId($client->id);

        $this->assertInstanceOf(Collection::class, $grids);
        $this->assertCount(3, $grids);
    }
}


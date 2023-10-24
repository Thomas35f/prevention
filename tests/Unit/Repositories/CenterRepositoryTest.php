<?php

namespace Tests\Unit\Repositories;

use App\Models\Center;
use App\Models\Client;
use App\Repositories\CenterRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class CenterRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the getCentersByClientId method of CenterRepository.
     *
     * @return void
     */
    public function testGetCentersByClientId()
    {
        $client = Client::factory()->create();

        $center1 = Center::factory()->create(['client_id' => $client->id]);
        $center2 = Center::factory()->create(['client_id' => $client->id]);
        $center3 = Center::factory()->create(['client_id' => $client->id]);

        $centerRepository = new CenterRepository(new Center());

        $centers = $centerRepository->getCentersByClientId($client->id);

        $this->assertInstanceOf(Collection::class, $centers);
        $this->assertCount(3, $centers);
    }

}


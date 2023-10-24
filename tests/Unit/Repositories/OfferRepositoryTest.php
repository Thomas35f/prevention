<?php

namespace Tests\Unit\Repositories;

use App\Models\Offer;
use App\Repositories\OfferRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class OfferRepositoryTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test the GetAllOffers method of OfferRepository.
     *
     * @return void
     */
    public function testGetAllOffers()
    {
        $offerMock = Mockery::mock(Offer::class);
        $offerMock->shouldReceive('all')->once()->andReturn(new Collection);

        $offerRepository = new OfferRepository($offerMock);

        $result = $offerRepository->getAllOffers();

        $this->assertInstanceOf(Collection::class, $result);
    }

}

<?php

namespace Tests\Unit\Repositories;

use App\Models\User;
use App\Repositories\TrainerRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class TrainerRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the getTrainers method of TrainerRepository.
     *
     * @return void
     */
    public function testGetTrainers()
    {
        $userMock = Mockery::mock(User::class);
        $userMock->shouldReceive('all')->once()->andReturn(new Collection);

        $trainerRepository = new TrainerRepository($userMock);

        $result = $trainerRepository->getTrainers();

        $this->assertInstanceOf(Collection::class, $result);
    }

}

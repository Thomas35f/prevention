<?php

namespace Tests\Unit\Repositories;

use App\Models\Center;
use App\Models\Client;
use App\Models\Trainer;
use App\Models\Training;
use App\Models\User;
use App\Repositories\TrainingRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class TrainingRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the getTrainings method of TrainingRepository.
     *
     * @return void
     */
    public function testGetTrainings()
    {
        $user = User::factory()->create();
        $trainer = Trainer::factory()->create(['user_id' => $user->id]);

        $training1 = Training::factory()->create(['trainer_id' => $trainer->id]);
        $training2 = Training::factory()->create(['trainer_id' => $trainer->id]);

        $trainingRepository = new TrainingRepository(new Training());

        $result = $trainingRepository->getTrainingsByTrainerClientId($user->client_id);

        $this->assertInstanceOf(Collection::class, $result);
    }

}


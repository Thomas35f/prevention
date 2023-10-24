<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\Center;
use App\Models\Grid;
use App\Models\Offer;
use App\Models\Subclient;
use App\Models\Trainer;
use App\Models\Training;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TrainingControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Get trainings
     */
    public function test_get_trainings_for_current_user()
    {
        $user = User::factory()->create();
        $trainer = Trainer::factory()->create(['user_id' => $user->id]);
        $training = Training::factory()->create(['trainer_id' => $trainer->id]);

        $this->actingAs($user);

        $response = $this->json('GET', '/api/getTrainings');

        $response->assertStatus(200)
        ->assertJson([
            'trainings' => [
                ['id' => $training->id, 'name' => $training->name],
            ]
        ]);
    }

    /**
     * Test Create Training
     */
    public function test_create_training()
    {

        $offer = Offer::factory()->create(['name' => 'Plus']);
        $user = User::factory()->create();
        $trainer = Trainer::factory()->create(['user_id' => $user->id]);
        $center = Center::factory()->create();
        $grid = Grid::factory()->create();
        $subclient = Subclient::factory()->create();

        $this->actingAs($user);

        $trainingData = [
            'training_name' => 'Training Test',
            'center_id' => $center->id,
            'training_date' => now()->addDay()->format('Y-m-d'),
            'subclient_id' => $subclient->id,
            'grid_id' => $grid->id
        ];


        $response = $this->json('POST', '/api/trainings/create', $trainingData);

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('trainings', [
            'name' => 'Training Test',
            'center_id' => $center->id,
            'offer_id' => $offer->id,
            'trainer_id' => $trainer->id,
        ]);
    }

    /**
     * Test get Training by id
     */
    public function test_get_training_by_id_exists()
    {
        $user = User::factory()->create();
        Trainer::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $training = Training::factory()->create();

        $response = $this->json('GET', '/api/getTraining/' . $training->id);

        $response->assertStatus(200);
        $response->assertJson(['training' => $training->toArray()]);
    }

    /**
     * Test get Training by id not exists
     */
    public function test_get_training_by_id_not_exists()
    {
        $user = User::factory()->create();
        Trainer::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->json('GET', '/api/getTraining/999999');

        $response->assertStatus(404);
        $response->assertJson(['message' => 'Formation non trouvée']);
    }

    /**
     * Test Update Training
     */
    public function test_update_training()
    {
        $user = User::factory()->create();
        $trainer = Trainer::factory()->create(['user_id' => $user->id]);
        $training = Training::factory()->create(['trainer_id' => $trainer->id]);
        $center = Center::factory()->create();
        $grid = Grid::factory()->create();
        $subclient = Subclient::factory()->create();

        $this->actingAs($user);

        $updatedTrainingData = [
            'training_name' => 'Updated Training Name',
            'center_id' => $center->id,
            'training_date' => now()->addDay()->format('Y-m-d'),
            'subclient_id' => $subclient->id,
            'grid_id' => $grid->id
        ];

        $response = $this->json('POST', '/api/trainings/update/' . $training->id, $updatedTrainingData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('trainings', [
            'id' => $training->id,
            'name' => 'Updated Training Name',
        ]);
    }

    /**
     * Test Update Non-Existent Training
     */
    public function test_update_non_existent_training()
    {
        $user = User::factory()->create();
        $trainer = Trainer::factory()->create(['user_id' => $user->id]);
        $training = Training::factory()->create(['trainer_id' => $trainer->id]);
        $center = Center::factory()->create();
        $grid = Grid::factory()->create();
        $subclient = Subclient::factory()->create();

        $this->actingAs($user);

        $updatedTrainingData = [
            'training_name' => 'Updated Training Name',
            'center_id' => $center->id,
            'training_date' => now()->addDay()->format('Y-m-d'),
            'subclient_id' => $subclient->id,
            'grid_id' => $grid->id
        ];

        $response = $this->json('POST', '/api/trainings/update/999999', $updatedTrainingData);

        $response->assertStatus(500);
        $response->assertJson(['message' => 'Erreur lors de la mise à jour de la formation']);
    }
}

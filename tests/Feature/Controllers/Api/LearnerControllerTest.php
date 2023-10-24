<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\Company;
use App\Models\Subclient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LearnerControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Store Learner
     */
    public function test_store_learner()
    {
        Artisan::call('create:roles');
        Artisan::call('create:clients');

        $trainer = User::factory()->create();
        $this->actingAs($trainer);

        $client = Company::where('name', 'Lery Technologies')->first();
        $subClient = Subclient::factory([
            'client_id'=>$client->id,
        ])->create();

        $learnerData = [
            "lastname" => "Doe",
            "firstname" => "John",
            "email" => "johndoe@example.com",
            "phone" => "1234567890",
            "address" => "123 Test St",
            "zip_code" => "12345",
            "town" => "Test town",
            'subclient_id' => $subClient->id,
        ];

        $response = $this->json('POST', '/api/learners/store', $learnerData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'message',
                'learner' => [
                    'user' => [
                        'lastname',
                        'firstname',
                        'email',
                        'phone',
                        'address',
                        'zip_code',
                        'town',
                    ],
                ],
            ]);
    }

}

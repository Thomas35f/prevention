<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\User;
use App\Models\Client;
use App\Models\Subclient;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubClientControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_fetches_subclients_for_authenticated_user()
    {
        $company = Company::factory()->create();

        $client = Client::factory()->create();

        $user = User::factory()->create(['client_id' => $client->id]);

        $subClient = SubClient::factory()->create([
            'client_id' => $client->id,
            'company_id' => $company->id
        ]);

        $this->actingAs($user);

        $response = $this->getJson('/api/getSubclients');

        $response->assertStatus(200);

            $response->assertJsonFragment([
                'id' => $subClient->id,
                'company_id' => $company->id,
                'client_id' => $client->id
            ]);
    }
}

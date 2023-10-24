<?php

namespace Tests\Feature\Auth;

use App\Models\Company;
use App\Models\Subclient;
use App\Models\Trainer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect(route('dashboard'));

        $response->assertSessionHas(['token', 'firstname', 'lastname']);
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_guest_users_are_redirected_to_login_page(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_access_with_correct_ability()
    {
        $userWithAbility = User::factory()->create();
        $token = $userWithAbility->createToken('TestToken', ['user-get-user'])->plainTextToken;
        $headers = ['Authorization' => 'Bearer ' . $token];

        Artisan::call('create:roles');
        Artisan::call('create:clients');
        $trainer = User::factory()->create();
        $this->actingAs($trainer);
        $client = Company::where('name', 'Lery Technologies')->first();
        $subClient = Subclient::factory(['client_id' => $client->id])->create();

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
        $response = $this->withHeaders($headers)->postJson('/api/learners/store', $learnerData);

        $response->assertStatus(201);
    }

    public function test_access_with_incorrect_ability()
    {
        $userWithoutAbility = User::factory()->create();

        $token = $userWithoutAbility->createToken('TestToken', ['wrong-ability'])->plainTextToken;

        $headers = ['Authorization' => 'Bearer ' . $token];

        $response = $this->withHeaders($headers)->postJson('/api/learners/store');
        $response->assertStatus(403);
    }
}

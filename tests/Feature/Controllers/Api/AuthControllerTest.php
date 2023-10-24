<?php

namespace Tests\Feature\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test User Registration
     */
    public function test_register()
    {
        Artisan::call('create:roles');
        $userData = [
            "lastname" => "Test User",
            "firstname" => "Test",
            "phone" => "1234567890",
            "address" => "123 Test St",
            "email" => "testuser@example.com",
            "password" => "test12345",
            "password_confirmation" => "test12345",
        ];

        $response = $this->json('POST','/api/register', $userData);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'name',
                    'token'
                ]
            ]);

        $this->assertDatabaseHas('users', ['email' => 'testuser@example.com']);
    }

    /**
     * Test User Login
     */
    public function test_login()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => bcrypt('test123'),
        ]);

        $loginData = ['email' => 'testuser@example.com', 'password' => 'test123'];

        $response = $this->json('POST', '/api/login', $loginData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'name',
                    'token'
                ]
            ]);
    }

    /**
     * Test User Login Fail
     */
    public function test_login_fail()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => bcrypt('test123'),
        ]);

        $loginData = ['email' => 'testuser@example.com', 'password' => 'wrong_password'];

        $response = $this->json('POST', '/api/login', $loginData);

        $response->assertStatus(401)
            ->assertJson([
                'data' => [
                    'error' => 'Unauthorised',
                ],
            ]);
    }

}



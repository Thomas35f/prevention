<?php

namespace Tests\Unit\Models;

use App\Models\Client;
use App\Models\Company;
use App\Models\Learner;
use App\Models\Role;
use App\Models\Training;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fillable attributes.
     *
     * @return void
     */
    public function test_fillable_attributes(): void
    {
        $user = new User([
            'lastname' => 'Doe',
            'firstname' => 'John',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'password' => 'password',
            'address' => '123 Main St',
            'zip_code' => '12345',
            'town' => 'Townsville',
        ]);

        $this->assertEquals('Doe', $user->lastname);
        $this->assertEquals('John', $user->firstname);
        $this->assertEquals('john@example.com', $user->email);

    }

    /**
     * Test user-client relationship.
     *
     * @return void
     */
    public function test_user_has_client(): void
    {
        $client = Client::factory()->create();
        $user = User::factory()->create(['client_id' => $client->id]);

        $this->assertInstanceOf(Client::class, $user->client);
        $this->assertEquals($client->id, $user->client->id);
    }

    /**
     * Test user-role relationship.
     *
     * @return void
     */
    public function test_user_has_role(): void
    {
        $role = Role::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->assertInstanceOf(Role::class, $user->role);
        $this->assertEquals($role->id, $user->role->id);
    }

}

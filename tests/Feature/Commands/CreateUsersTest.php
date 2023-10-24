<?php

namespace Tests\Feature\Commands;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUsersTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateUsersCommand()
    {
        Artisan::call('create:clients');
        Artisan::call('create:roles');

        $this->artisan('create:users')
            ->assertExitCode(0);


            $this->assertDatabaseHas('users', [
                'firstname' => 'Maxime',
                'lastname' => 'Rousseau',
            ]);
    }

    public function testUserExists()
    {
        Artisan::call('create:clients');
        Artisan::call('create:roles');
        Artisan::call('create:users');
        Artisan::call('create:users');

        $output = Artisan::output();

        $this->assertStringContainsString('EXISTS', $output);
    }

}

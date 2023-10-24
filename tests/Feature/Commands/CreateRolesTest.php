<?php

namespace Tests\Feature\Commands;

use App\Console\Commands\CreateRoles;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateRolesTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateRolesCommand()
    {
        $this->artisan('create:roles')
            ->assertExitCode(0);

        foreach (CreateRoles::ROLES as $role) {
            $this->assertDatabaseHas('roles', [
                'name' => $role['name'],
                'description' => $role['description'],
            ]);
        }
    }

    public function testRoleExists()
    {
        Artisan::call('create:roles');
        Artisan::call('create:roles');

        $output = Artisan::output();

        $this->assertStringContainsString('EXISTS', $output);
    }

}

<?php

namespace Tests\Feature\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaunchDataTest extends TestCase
{
    use RefreshDatabase;

    public function testLaunchDataCommand()
    {
        $this->artisan('create:all')
            ->assertExitCode(0);

        $this->assertDatabaseCount('roles', 5);
        $this->assertDatabaseCount('clients', 1);
        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseCount('offers', 3);
        $this->assertDatabaseCount('features', 5);
        $this->assertDatabaseCount('centers', 1);
        $this->assertDatabaseCount('grids', 1);
    }

}

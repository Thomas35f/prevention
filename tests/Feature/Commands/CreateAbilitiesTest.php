<?php

namespace Tests\Feature\Commands;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateAbilitiesTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateAbilities()
    {
        Artisan::call('create:roles');

        Artisan::call('create:abilities');

        $this->assertDatabaseCount('abilities', 19);

        $this->assertDatabaseHas('abilities', [
            'name' => 'user:get:user',
            'description' => 'Visualize user\'s info',
            'role_id' => 1,
        ]);
    }

}

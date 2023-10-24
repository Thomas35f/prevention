<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateMethod()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->get('/dashboard');

        $response->assertSuccessful();
    }

}


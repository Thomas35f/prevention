<?php

namespace Tests\Feature\Commands;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCentersTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCenters()
    {
        Artisan::call('create:centers');

        $output = Artisan::output();

        $this->assertStringContainsString('Failed to insert centers', $output);
    }

}

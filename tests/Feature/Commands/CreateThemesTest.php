<?php

namespace Tests\Feature\Commands;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThemesTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateThemes()
    {
        Artisan::call('create:themes');

        $output = Artisan::output();

        $this->assertStringContainsString('THEMES : Nothing to add', $output);
    }

}

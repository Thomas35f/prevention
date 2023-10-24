<?php

namespace Tests\Feature\Commands;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCriteriaTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCriteria()
    {
        Artisan::call('create:criteria');

        $output = Artisan::output();

        $this->assertStringContainsString('CRITERIA : Nothing to add', $output);
    }

}

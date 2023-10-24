<?php

namespace Tests\Feature\Commands;

use App\Console\Commands\CreateFeatures;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateFeaturesTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateFeaturesCommand()
    {
        Artisan::call('create:offers');
        $this->artisan('create:features')
            ->assertExitCode(0);

        foreach (CreateFeatures::FEATURES as $feature) {
            $this->assertDatabaseHas('features', $feature);
        }
    }

    public function testFeatureExists()
    {
        Artisan::call('create:offers');

        Artisan::call('create:features');
        Artisan::call('create:features');

        $output = Artisan::output();

        $this->assertStringContainsString('EXISTS', $output);
    }

}

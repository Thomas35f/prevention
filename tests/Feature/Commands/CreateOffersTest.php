<?php

namespace Tests\Feature\Commands;

use App\Console\Commands\CreateOffers;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateOffersTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateOffersCommand()
    {
        $this->artisan('create:offers')
            ->assertExitCode(0);

        foreach (CreateOffers::OFFERS as $offer) {
            $this->assertDatabaseHas('offers', $offer);
        }
    }

    public function testOfferExists()
    {
        Artisan::call('create:offers');
        Artisan::call('create:offers');
        $output = Artisan::output();

        $this->assertStringContainsString('EXISTS', $output);
    }

}

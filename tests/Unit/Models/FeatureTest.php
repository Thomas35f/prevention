<?php

namespace Tests\Unit\Models;

use App\Models\Feature;
use App\Models\Offer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the feature relation.
     *
     * @return void
     */
    public function test_offer_relation()
    {
        $offer = Offer::factory()->create();
        $feature = Feature::factory()->create(['offer_id' => $offer->id]);

        $this->assertInstanceOf(Offer::class, $feature->offer);
        $this->assertEquals($offer->id, $feature->offer->id);
    }

}

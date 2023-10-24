<?php

namespace Tests\Unit\Models;

use App\Models\Feature;
use App\Models\Training;
use App\Models\Offer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OfferTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the training relation.
     *
     * @return void
     */
    public function test_training_relation(): void
    {
        $offer = Offer::factory()->create();
        $training = Training::factory()->create(['offer_id' => $offer->id]);

        $this->assertInstanceOf(Training::class, $offer->trainings->first());
        $this->assertEquals($training->id, $offer->trainings->first()->id);
    }

    /**
     * Test the feature relation.
     *
     * @return void
     */
    public function test_feature_relation(): void
    {
        $offer = Offer::factory()->create();
        $feature = Feature::factory()->create(['offer_id' => $offer->id]);

        $this->assertInstanceOf(Feature::class, $offer->features->first());
        $this->assertEquals($feature->id, $offer->features->first()->id);
    }

}

<?php

namespace Tests\Feature\Controllers;

use App\Models\Offer;
use Tests\TestCase;

class OfferControllerTest extends TestCase
{
    /**
     * Test the offers page.
     *
     * @return void
     */
    public function test_offers_page_is_displayed_correctly(): void
    {
        Offer::factory()->count(3)->create();
        $response = $this->get('/offers');

        $response->assertStatus(200);
        $response->assertViewIs('offers');
        $response->assertViewHas('offers', function($offers) {
            return count($offers) >= 3;
        });
    }
}


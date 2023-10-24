<?php

namespace Tests\Unit\Models;

use App\Models\Client;
use App\Models\Company;
use App\Models\Learner;
use App\Models\Subclient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class SubclientTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test company relation.
     *
     * @return void
     */
    public function test_company_relation(): void
    {
        $company = Company::factory()->create();
        $subclient = Subclient::factory()->create(['company_id' => $company->id]);

        $this->assertInstanceOf(Company::class, $subclient->company);
        $this->assertEquals($company->id, $subclient->company->id);
    }

    /**
     * Test client relation.
     *
     * @return void
     */
    public function test_client_relation(): void
    {
        $client = Client::factory()->create();
        $subclient = Subclient::factory()->create(['client_id' => $client->id]);

        $this->assertInstanceOf(Client::class, $subclient->client);
        $this->assertEquals($client->id, $subclient->client->id);
    }

    /**
     * Test learners relation.
     *
     * @return void
     */
    public function test_learners_relation(): void
    {
        $subclient = Subclient::factory()->create();
        $learner = Learner::factory()->create(['subclient_id' => $subclient->id]);

        $this->assertInstanceOf(Learner::class, $subclient->learners->first());
        $this->assertEquals($learner->id, $subclient->learners->first()->id);
    }

}

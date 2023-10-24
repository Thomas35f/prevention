<?php

namespace Tests\Unit\Models;

use App\Models\Center;
use App\Models\Client;
use App\Models\Company;
use App\Models\Grid;
use App\Models\Subclient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
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
        $client = Client::factory()->create(['company_id' => $company->id]);

        $this->assertInstanceOf(Company::class, $client->company);
        $this->assertEquals($company->id, $client->company->id);
    }

    /**
     * Test subclients relation.
     *
     * @return void
     */
    public function test_subclients_relation(): void
    {
        $client = Client::factory()->create();
        $subclient = Subclient::factory()->create(['client_id' => $client->id]);

        $this->assertInstanceOf(Subclient::class, $client->subclients->first());
        $this->assertEquals($subclient->id, $client->subclients->first()->id);
    }

    /**
     * Test users relation.
     *
     * @return void
     */
    public function test_users_relation(): void
    {
        $client = Client::factory()->create();
        $user = User::factory()->create(['client_id' => $client->id]);

        $this->assertInstanceOf(User::class, $client->users->first());
        $this->assertEquals($user->id, $client->users->first()->id);
    }

    /**
     * Test centers relation.
     *
     * @return void
     */
    public function test_centers_relation(): void
    {
        $client = Client::factory()->create();
        $center = Center::factory()->create(['client_id' => $client->id]);

        $this->assertInstanceOf(Center::class, $client->centers->first());
        $this->assertEquals($center->id, $client->centers->first()->id);
    }

    /**
     * Test grids relation.
     *
     * @return void
     */
    public function test_grids_relation(): void
    {
        $client = Client::factory()->create();
        $grid = Grid::factory()->create(['client_id' => $client->id]);

        $this->assertInstanceOf(Grid::class, $client->grids->first());
        $this->assertEquals($grid->id, $client->grids->first()->id);
    }
}

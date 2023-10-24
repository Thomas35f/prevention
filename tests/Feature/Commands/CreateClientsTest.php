<?php

namespace Tests\Feature\Commands;

use App\Console\Commands\CreateClients;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CreateClientsTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateClientsCommand()
    {
        $this->artisan('create:clients')
            ->assertExitCode(0);

        $firstClient = CreateClients::CLIENTS[0];
        $this->assertDatabaseHas('companies', [
            'name' => $firstClient['name']
        ]);
        $company = Company::where('name', $firstClient['name'])->first();
        $this->assertDatabaseHas('clients', [
            'company_id' => $company->id
        ]);
    }

    public function testClientExists()
    {
        Artisan::call('create:clients');
        Artisan::call('create:clients');

        $output = Artisan::output();

        $this->assertStringContainsString('EXISTS', $output);
    }

}


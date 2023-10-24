<?php

namespace Tests\Unit\Models;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test create company.
     *
     * @return void
     */
    public function test_can_create_company()
    {
        $company = Company::create([
            'name' => 'Test Company',
            'address_line_1' => '123 Test Street',
            'address_line_2'=>fake()->streetAddress(),
            'zip_code' => '12345',
            'town' => 'Test Town',
            'contact' => 'Test Contact',
        ]);

        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
            'address_line_1' => '123 Test Street',
            'zip_code' => '12345',
            'town' => 'Test Town',
            'contact' => 'Test Contact',
        ]);
    }

}

<?php

namespace Tests\Unit\Repositories;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class CompanyRepositoryTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test the getCompanies method of CompanyRepository.
     *
     * @return void
     */
    public function testGetCompanies()
    {
        $companyMock = Mockery::mock(Company::class);
        $companyMock->shouldReceive('all')->once()->andReturn(new Collection);

        $companyRepository = new CompanyRepository($companyMock);

        $result = $companyRepository->getCompanies();

        $this->assertInstanceOf(Collection::class, $result);
    }

}

<?php

namespace App\Repositories;

use App\Interfaces\CompanyInterface;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository implements CompanyInterface
{
    protected Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function getCompanies(): Collection
    {
        return $this->company->all();
    }

}


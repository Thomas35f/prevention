<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CompanyInterface
{
    public function getCompanies(): Collection;
}

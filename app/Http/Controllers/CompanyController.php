<?php

namespace App\Http\Controllers;

use App\Interfaces\CompanyInterface;
use App\Models\Company;

class CompanyController extends Controller
{
    private CompanyInterface $companyRepository;

    public function __construct(CompanyInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    public function index()
    {
        $companies = $this->companyRepository->getCompanies();

        return response()->json([
            'companies' => $companies
        ], 201);
    }

}

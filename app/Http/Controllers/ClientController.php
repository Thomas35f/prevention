<?php

namespace App\Http\Controllers;

use App\dtos\ClientDto;
use App\Models\Client;
use App\Models\Company;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function store(Request $request)
    {
        $this->clientService->store(ClientDto::fromRequest($request));
    }
}

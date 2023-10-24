<?php

namespace App\Services;

use App\dtos\Dto;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientService
{
    private  ClientRepository $clientRepository;
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function store(Dto $dto)
    {
        $this->clientRepository->store($dto);
    }
}

<?php

namespace App\Repositories;

use App\dtos\Dto;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientRepository
{
    private  Client $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAll()
    {
        return $this->client::all();
    }

    public function store(Dto $dto)
    {

    }
}

<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface GridInterface
{
    public function getGridsByClientId($clientId): Collection;
}



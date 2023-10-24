<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CenterInterface
{
    public function getCentersByClientId($clientId): Collection;
}


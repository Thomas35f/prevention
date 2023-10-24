<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface TrainerInterface
{
    public function getTrainers(): Collection;
}


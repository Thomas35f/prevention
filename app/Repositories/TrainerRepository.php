<?php

namespace App\Repositories;

use App\Interfaces\TrainerInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TrainerRepository implements TrainerInterface
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getTrainers(): Collection
    {
        return $this->user->all();
    }

}

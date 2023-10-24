<?php

namespace App\Interfaces;

use App\Models\User;

interface  AbilityRepository
{
    public function getAbilities(\Illuminate\Contracts\Auth\Authenticatable $user);
}

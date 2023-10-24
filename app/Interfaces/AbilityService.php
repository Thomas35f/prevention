<?php

namespace App\Interfaces;

use App\Models\User;

interface AbilityService
{
    /**
     * get abilities of a user
     *
     * @param User $user
     * @return array<int, string>
     */
    public function getAbilities(\Illuminate\Contracts\Auth\Authenticatable $user);
}

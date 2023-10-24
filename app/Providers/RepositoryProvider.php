<?php

namespace App\Providers;

use App\Interfaces\AbilityRepository;
use App\Models\Ability;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider implements  AbilityRepository
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function getAbilities(\Illuminate\Contracts\Auth\Authenticatable $user)
    {
        $firstWhere = true;
        $query = DB::table('abilities');
        switch ($user->role_id) {
            case 1:
                $query = $query->where('role_id', 1);
                $firstWhere = false;
            case 2:
                $firstWhere?$query=$query->where('role_id', 2):$query=$query->orWhere('role_id', 2);
                $firstWhere = false;
            case 3:
                $firstWhere?$query=$query->where('role_id', 3):$query=$query->orWhere('role_id', 3);
                $firstWhere = false;
                break;
            default:
                throw new \Exception('no valid role id '.$user->role_id.' for user '.$user->lastname);
        }
        $abilities = $query->get();
        return 'get-user-store';//$this->abilityService->getAbilities($user);
//        return $abilities;
    }
}

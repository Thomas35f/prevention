<?php

namespace App\Providers;

use App\Interfaces\AbilityService;
use App\Models\User;
//use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Contracts\Foundation\Application as App;
class AbilityProvider extends ServiceProvider implements AbilityService
{
    protected AbilityService $abilityService;
    public function __construct(AbilityService $abilityService, App $app,)
    {
        parent::__construct($app);
        $this->abilityService = $abilityService;
    }

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
        return $this->abilityService->getAbilities($user);
    }
}

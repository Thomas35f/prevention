<?php

namespace App\Providers;

use App\Interfaces\AbilityRepository as InterfaceAbilityRepository;
use App\Interfaces\AbilityService as InterfaceAbilityService;
use App\Interfaces\CenterInterface;
use App\Interfaces\CompanyInterface;
use App\Interfaces\GridInterface;
use App\Interfaces\LearnerInterface;
use App\Interfaces\LessonInterface;
use App\Interfaces\OfferInterface;
use App\Interfaces\TrainerInterface;
use App\Interfaces\TrainingInterface;
use App\Providers\AbilityProvider as AbilityServiceProvider;
use App\Providers\RepositoryProvider as AbilityRepository;
use App\Repositories\CenterRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\GridRepository;
use App\Repositories\LearnerRepository;
use App\Repositories\LessonRepository;
use App\Repositories\OfferRepository;
use App\Repositories\TrainerRepository;
use App\Repositories\TrainingRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(InterfaceAbilityService::class, AbilityServiceProvider::class);
        $this->app->bind(InterfaceAbilityRepository::class, AbilityRepository::class);
        $this->app->bind(OfferInterface::class, OfferRepository::class);
        $this->app->bind(TrainerInterface::class, TrainerRepository::class);
        $this->app->bind(CompanyInterface::class, CompanyRepository::class);
        $this->app->bind(TrainingInterface::class, TrainingRepository::class);
        $this->app->bind(CenterInterface::class, CenterRepository::class);
        $this->app->bind(GridInterface::class, GridRepository::class);
        $this->app->bind(LearnerInterface::class, LearnerRepository::class);
        $this->app->bind(LessonInterface::class, LessonRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}

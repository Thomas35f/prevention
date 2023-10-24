<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */

    protected $commands = [

        Commands\CreateAbilities::class,
        Commands\CreateCenters::class,
        Commands\CreateClients::class,
        Commands\CreateCriteria::class,
        Commands\CreateFeatures::class,
        Commands\CreateGrids::class,
        Commands\CreateOffers::class,
        Commands\CreateRoles::class,
        Commands\CreateThemes::class,
        Commands\CreateUsers::class,
        Commands\LaunchData::class
    ];

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}

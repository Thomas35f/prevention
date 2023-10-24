<?php

namespace App\Console\Commands;

use App\Models\Grid;
use App\Models\Company;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Console\View\Components\TwoColumnDetail;
use Illuminate\Support\Facades\DB;

class CreateGrids extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:grids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Grading Grids for App';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->call('create:grid-acp-driving-pl');

        return self::SUCCESS;
    }
}

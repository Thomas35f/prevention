<?php

namespace App\Console\Commands;


use App\Models\Criterion;
use App\Models\Theme;
use Illuminate\Console\Command;

class CreateCriteria extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:criteria';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Criteria for App';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line('  <fg=yellow;options=bold>CRITERIA :</> <fg=default>Nothing to add</>');
        return self::SUCCESS;
    }
}

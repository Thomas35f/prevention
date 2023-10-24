<?php

namespace App\Console\Commands;

use App\Models\Center;
use App\Models\Client;
use App\Models\Company;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Console\View\Components\TwoColumnDetail;
use Illuminate\Support\Facades\DB;

class CreateCenters extends Command
{
    const CENTERS = [
        [
            'name' => 'Circuit de Rennes',
            'address' => '1 Rue de Paris 35510, Cesson-Sévigné',
        ],
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:centers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Centers for App';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            $client = Company::where('name', 'Lery Technologies')->firstOrFail();
            foreach (self::CENTERS as $centerData) {
                $centerData['client_id'] = $client->id;
                if (!Center::where('name', $centerData['name'])->exists()) {
                    $center = new Center($centerData);
                    $center->save();
                    with(new TwoColumnDetail($this->getOutput()))->render(
                        '<fg=yellow;options=bold>CENTER : </>' . $center['name'],
                        '<fg=yellow;options=bold>ADDED</>'
                    );
                } else {
                    with(new TwoColumnDetail($this->getOutput()))->render(
                        '<fg=yellow;options=bold>CENTER : </>' . $center['name'],
                        '<bg=red;options=bold>EXISTS</>'
                    );
                }
            }
        } catch (Exception $e) {
            with(new TwoColumnDetail($this->getOutput()))->render(
                '<fg=red;options=bold>CENTER: </>' . $e->getMessage(),
                '<fg=red;options=bold>Failed to insert centers</>'
            );
        }
        return self::SUCCESS;
    }

}

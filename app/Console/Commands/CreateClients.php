<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Company;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Console\View\Components\TwoColumnDetail;
use Illuminate\Support\Facades\DB;

class CreateClients extends Command
{
    public const LERY_TECHNOLOGIES = 1;
    const CLIENTS = [
        [
            'id' => self::LERY_TECHNOLOGIES,
            'name' => 'Lery Technologies',
            'address_line_1' => '1 rue de Paris',
            'zip_code' => '35510',
            'town' => 'Cesson Sévigné'
        ],
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:clients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Companies for Clients and link them';

    /**
     * Execute the console command.
     *
     * @return int
     */
        public function handle(): int
        {
            DB::beginTransaction();

            try {
                foreach (self::CLIENTS as $clientData) {
                    $company = Company::firstOrCreate(['name' => $clientData['name']], $clientData);

                    $client = Client::firstOrCreate(['company_id' => $company->id]);

                    with(new TwoColumnDetail($this->getOutput()))->render(
                        '<fg=yellow;options=bold>COMPANY : </>' . $company->name,
                        $company->wasRecentlyCreated ? '<fg=yellow;options=bold>ADDED</>' : '<bg=red;options=bold>EXISTS</>'
                    );

                    with(new TwoColumnDetail($this->getOutput()))->render(
                        '<fg=yellow;options=bold>CLIENT LINKED TO COMPANY : </>' . $company->name,
                        $client->wasRecentlyCreated ? '<fg=yellow;options=bold>ADDED</>' : '<bg=red;options=bold>EXISTS</>'
                    );
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollback();

                with(new TwoColumnDetail($this->getOutput()))->render(
                    '<fg=red;options=bold>Error: </>' . $e->getMessage(),
                    '<fg=red;options=bold>Failed to insert and link companies and clients</>'
                );
                return self::FAILURE;
            }

            return self::SUCCESS;
        }
}


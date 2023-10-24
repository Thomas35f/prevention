<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Company;
use App\Models\Subclient;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Console\View\Components\TwoColumnDetail;
use Illuminate\Support\Facades\DB;

class CreateSubclient extends Command
{
    const CLIENT_NAME = 'Lery Technologies';
    const SUBCLIENTS = [
        [
            'name' => 'EDF',
            'address_line_1' => "1 rue de l'éergie",
            'zip_code' => '3500',
            'town' => 'Rennes'
        ],
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:subclient';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create subclient';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $client = Client::whereCompanyName('Lery Technologies')->first();

        DB::beginTransaction();
        try {
            foreach (self::SUBCLIENTS as $clientData) {
                $company = Company::firstOrCreate(['name' => $clientData['name']], $clientData);

                $subclient = Subclient::firstOrCreate([
                    'company_id' => $company->id,
                    'client_id'=>$client->company->id
                ]);

                with(new TwoColumnDetail($this->getOutput()))->render(
                    '<fg=yellow;options=bold>SUBCLIENT : </>' . $company->name,
                    $company->wasRecentlyCreated ? '<fg=yellow;options=bold>ADDED</>' : '<bg=red;options=bold>EXISTS</>'
                );

                with(new TwoColumnDetail($this->getOutput()))->render(
                    '<fg=yellow;options=bold>SUBCLIENT LINKED TO CLIENT : </>' . $client->name,
                    $subclient->wasRecentlyCreated ? '<fg=yellow;options=bold>ADDED</>' : '<bg=red;options=bold>EXISTS</>'
                );
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            with(new TwoColumnDetail($this->getOutput()))->render(
                '<fg=red;options=bold>Error: </>' . $e->getMessage(),
                '<fg=red;options=bold>Failed to insert and link companies and subclients</>'
            );
            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Feature;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Console\View\Components\TwoColumnDetail;
use Illuminate\Support\Facades\DB;

class CreateFeatures extends Command
{
    const OFFER_PLUS = 1;
    const OFFER_BUSINESS = 2;
    const OFFER_ENTERPRISE = 3;

    const FEATURES = [
        [
            'label' => 'Gérer les stagiaires',
            'offer_id' => self::OFFER_PLUS,
        ],
        [
            'label' => 'Saisir les informations',
            'offer_id' => self::OFFER_PLUS,
        ],
        [
            'label' => 'Données envoyées en interne',
            'offer_id' => self::OFFER_BUSINESS,
        ],
        [
            'label' => 'Données envoyées sur le LRS',
            'offer_id' => self::OFFER_ENTERPRISE,
        ],
        [
            'label' => 'Interface et gestion des données sur demande',
            'offer_id' => self::OFFER_ENTERPRISE,
        ],
    ];


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:features';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Features for App';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {

        try {
            foreach (self::FEATURES as $feature) {
                if (!Feature::where('label', $feature['label'])->exists()) {
                    DB::table('features')->insert([
                        $feature
                    ]);
                    with(new TwoColumnDetail($this->getOutput()))->render(
                        '<fg=yellow;options=bold>FEATURE : </>' . $feature['label'],
                        '<fg=yellow;options=bold>ADDED</>'
                    );
                } else {
                    with(new TwoColumnDetail($this->getOutput()))->render(
                        '<fg=yellow;options=bold>FEATURE : </>' . $feature['label'],
                        '<bg=red;options=bold>EXISTS</>'
                    );
                }
            }
        } catch (Exception $e) {

            with(new TwoColumnDetail($this->getOutput()))->render(
                '<fg=red;options=bold>Error: </>' . $e->getMessage(),
                '<fg=red;options=bold>Failed to insert features</>'
            );
        }
        return self::SUCCESS;
    }
}

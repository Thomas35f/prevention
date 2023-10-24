<?php

namespace App\Console\Commands\Grids;

use App\Console\Commands\CreateClients;
use App\Models\Grid;
use App\Models\Criterion;
use App\Models\Theme;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Console\View\Components\TwoColumnDetail;

class CreateGridACPDrivingPL extends Command
{
    const LERY_TECHNOLOGIES = CreateClients::LERY_TECHNOLOGIES;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:grid-acp-driving-pl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Grid ACP Driving PL with associated criteria and themes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {

            if (!Grid::where('name', 'Grille ACP Conduite PL')->exists()) {
                $grid = new Grid();
                $grid->name = 'Grille ACP Conduite PL';
                $grid->client_id = self::LERY_TECHNOLOGIES;
                $grid->save();

                $criteria = [
                    'Véhicule' => [
                        'propreté', 'habitacle', 'chargement', 'état', 'pneumatiques', 'documents de bord'
                    ],
                    'Position de conduite' => [
                        'installation', 'ceinture de sécurité', 'tenue du volant'
                    ],
                    'Identifier les situations dangereuses' => [
                        'vigilance / attention', 'observation', 'rétroviseurs', 'angles-morts', 'risque arrière'
                    ],
                    'Anticipation' => [
                        'voir', 'prévoir', 'décider'
                    ],
                    'Communiquer' => [
                        'appel de frein', 'utiliser ses clignotants', 'autres'
                    ],
                    'Respect' => [
                        'règles', 'autres usagers', 'environnement', 'matériel'
                    ],
                    'Respecter et adapter les distances de sécurité' => [
                        'à l\'arrêt', 'en circulation', 'adaptation', 'latérales'
                    ],
                    'S\'adapter à la visibilité' => [
                        'tracé de la route', 'intersection', 'situations particulières', 'conditions météo'
                    ],
                    'Adapter sa vitesse' => [
                        'environnement', 'adhérence', 'trafic', 'utilisation technologie'
                    ],
                    'Franchir les intersectons' => [
                        'détection', 'pied face au frein', 'respect priorité', 'allure'
                    ],
                    'Croisement' => [
                        'allure', 'sécurité'
                    ],
                    'Dépasser' => [
                        'prise de décision', 'rabattement'
                    ],
                    'Manœuvre' => [
                        'en circulation', 'stationnement', 'précision', 'technologie'
                    ],
                    'Spécificités conduite PL' => [
                        'prise de poste', 'montée / descente', 'contrôle pression air', 'gestion boite de vitesse',
                        'respect zone verte', 'position sur la chaussée', 'franchir les giratoires', 'gabarit',
                        'porte à faux av et ar', 'utilisation ralentisseurs', 'antéviseur', 'principaux',
                        'grand angle', 'accostage', 'mise à quai', 'équipement particulier', 'énergie cinétique',
                        'centre de gravité', 'force centrifuge'
                    ]
                ];


                foreach ($criteria as $criterionName => $themes) {
                    $criterion = Criterion::firstOrCreate(['label' => $criterionName]);
                    $grid->criteria()->attach($criterion);

                    foreach ($themes as $themeLabel) {
                        $theme = Theme::firstOrCreate(['label' => $themeLabel]);
                        $criterion->themes()->attach($theme);
                    }
                }

                with(new TwoColumnDetail($this->getOutput()))->render(
                    '<fg=yellow;options=bold>GRID : </>' . $grid->name,
                    '<fg=yellow;options=bold>ADDED</>'
                );

            } else {
                with(new TwoColumnDetail($this->getOutput()))->render(
                    '<fg=yellow;options=bold>GRID : </>Grille ACP Conduite PL',
                    '<bg=red;options=bold>EXISTS</>'
                );
            }

        } catch (Exception $e) {
            with(new TwoColumnDetail($this->getOutput()))->render(
                '<fg=red;options=bold>ERROR: </>' . $e->getMessage(),
                '<fg=red;options=bold>Failed to process Grille ACP Conduite PL</>'
            );
        }

        return self::SUCCESS;
    }
}


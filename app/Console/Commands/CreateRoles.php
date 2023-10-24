<?php

namespace App\Console\Commands;

use App\Models\Role;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Console\View\Components\TwoColumnDetail;
use Illuminate\Support\Facades\DB;

class CreateRoles extends Command
{
    const ROLE_SUPER_ADMIN = 1;
    const ROLE_LERY_ADMIN= 2;
    const ROLE_CLIENT_MANAGER = 3;
    const ROLE_CLIENT_INSTRUCTOR = 4;
    const ROLE_CLIENT_TRAINEE = 5;
    const ROLES = [
        ['id' => self::ROLE_SUPER_ADMIN, 'name' => 'super-admin', 'description' => 'Salarié Lery technologies. Peut ajouter, supprimer des clients et ajouter des domaines autorisés (nouveau client par exemple)',],
        ['id' => self::ROLE_LERY_ADMIN, 'name' => 'admin', 'description' => 'Salarié de l\'entreprise de formation. Peut voir et ajouter des formateurs',],
        ['id' => self::ROLE_CLIENT_MANAGER, 'name' => 'manager', 'description' => 'Accès aux pages statistiques globales, factures et contrats',],
        ['id' => self::ROLE_CLIENT_INSTRUCTOR, 'name' => 'instructor', 'description' => 'Peut ajouter des leçons et des apprenants',],
        ['id' => self::ROLE_CLIENT_TRAINEE, 'name' => 'guest', 'description' => 'Peut avoir accès aux informations de ses stages. C\'est par exemple un apprenant',],
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Roles for App';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            foreach (self::ROLES as $role) {
                if (!Role::where('name', $role['name'])->exists()) {
                    DB::table('roles')->insert([
                        $role
                    ]);
                    with(new TwoColumnDetail($this->getOutput()))->render(
                        '<fg=yellow;options=bold>ROLE : </>' . $role['name'],
                        '<fg=yellow;options=bold>ADDED</>'
                    );
                } else {
                    with(new TwoColumnDetail($this->getOutput()))->render(
                        '<fg=yellow;options=bold>ROLE : </>' . $role['name'],
                        '<bg=red;options=bold>EXISTS</>'
                    );
                }
            }
        } catch (Exception $e) {

            with(new TwoColumnDetail($this->getOutput()))->render(
                '<fg=red;options=bold>Error: </>' . $e->getMessage(),
                '<fg=red;options=bold>Failed to insert roles</>'
            );
        }
        return self::SUCCESS;
    }
}


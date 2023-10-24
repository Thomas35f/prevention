<?php

namespace App\Console\Commands;

use App\Models\Ability;
use App\Models\Role;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Console\View\Components\TwoColumnDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CreateAbilities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:abilities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create abilities for all users role';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $abilitiesByRole = [
            CreateRoles::ROLE_SUPER_ADMIN => [ // Super-admin
                [// ability
                    'name' => 'user:get:user',
                    'description' => 'Visualize user\'s info'
                ],
                [//ability
                    'name' => 'company:post:store',
                    'description' => 'Create a company'
                ],
                [//ability
                    'name' => 'company:delete',
                    'description' => 'Create a company'
                ],
                [//ability
                    'name' => 'company:patch',
                    'description' => 'Create a company'
                ],
                [//ability
                    'name' => 'vehicle:post:store',
                    'description' => 'Create a vehicle'
                ],
            ],
            CreateRoles::ROLE_LERY_ADMIN => [ // Admin
                [//ability
                    'name' => 'trainer:post:store',
                    'description' => 'Create a trainer'
                ],
            ],
            CreateRoles::ROLE_CLIENT_MANAGER => [ // Client Manager
                [//ability
                    'name' => 'trainer:post:lesson',
                    'description' => 'Add lessons'
                ],
            ],
            CreateRoles::ROLE_CLIENT_INSTRUCTOR => [ // instructor
                [//ability
                    'name' => 'trainer:post:session',
                    'description' => 'Create session'
                ],
            ],
            CreateRoles::ROLE_CLIENT_TRAINEE => [ // trainee
                [//ability
                    'name' => 'trainee:get:lessons',
                    'description' => 'See lessons'
                ],
            ],
        ];

        try {
            // Populate database with abilities
            // warning : no break between case. case order matters !
            foreach ($abilitiesByRole as $role => $abilities) {
                switch ($role) {
                    /** @noinspection PhpMissingBreakStatementInspection */
                    case 5:
                        $this->addAbilities(abilities: $abilities, role: Role::find(CreateRoles::ROLE_CLIENT_TRAINEE));
                    /** @noinspection PhpMissingBreakStatementInspection */
                    case 4:
                        $this->addAbilities($abilities, Role::find(CreateRoles::ROLE_CLIENT_INSTRUCTOR));
                    /** @noinspection PhpMissingBreakStatementInspection */
                    case 3:
                        $this->addAbilities($abilities, Role::find(CreateRoles::ROLE_CLIENT_MANAGER));
                    /** @noinspection PhpMissingBreakStatementInspection */
                    case 2:
                        $this->addAbilities($abilities, Role::find(CreateRoles::ROLE_LERY_ADMIN));
                    case 1:
                        $this->addAbilities($abilities, Role::find(CreateRoles::ROLE_SUPER_ADMIN));
                        break;
                    default:
                        throw new Exception("No abilities defined for role ".$role);
                }
            }
        } catch(Exception $e) {
            Log::error($e->getMessage());
            with(new TwoColumnDetail($this->getOutput()))->render(
                '<fg=yellow;options=bold>Warning : </>' . $e->getMessage(),
                '<fg=red;options=bold>ERROR</>');
            return CommandAlias::FAILURE;
        }
        return CommandAlias::SUCCESS;
    }

    /**
     * @param array $abilities
     * @param Role $role
     * @return void
     */
    protected function addAbilities(array $abilities, Role $role): void
    {
        foreach ($abilities as $ability) {
            if (!Ability::where('name', $ability['name'])
                ->where('role_id', $role->id)
                ->exists()) {
                DB::table('abilities')->insert([
                    'name' => $ability['name'],
                    'description' => $ability['description'],
                    'role_id' => $role->id
                ]);
                with(new TwoColumnDetail($this->getOutput()))->render(
                    '<fg=yellow;options=bold>Ability : </>' . $ability['name'].' for '.$role->name,
                    '<fg=yellow;options=bold>ADDED</>'
                );
            } else {
                with(new TwoColumnDetail($this->getOutput()))->render(
                    '<fg=yellow;options=bold>Ability : </>' . $ability['name'].' for '.$role->name,
                    '<fg=red;options=bold>EXISTS</>'
                );
            }
        }
    }
}

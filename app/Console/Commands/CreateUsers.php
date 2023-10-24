<?php

namespace App\Console\Commands;

use App\Models\Trainer;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Console\View\Components\TwoColumnDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateUsers extends Command
{
    const SUPER_ADMIN = CreateRoles::ROLE_SUPER_ADMIN;
    const LERY_TECHNOLOGIES = CreateClients::LERY_TECHNOLOGIES;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Users for App';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $users = [
            [
                'firstname' => 'Stephane',
                'lastname' =>Str::ucfirst('pau'),
                'email' => 'stephane.pau@smartmoov.solutions',
                'phone' => '0635192778',
                'password' => bcrypt('ilfi6klf'),
                'address' => '9 SQ. du roi arthur',
                'zip_code' => '35000',
                'town' => 'Rennes',
                'client_id' => self::LERY_TECHNOLOGIES,
                'role_id' => self::SUPER_ADMIN
            ],
            [
                'firstname' => 'Maxime',
                'lastname' => 'Rousseau',
                'email' => 'maxime.rousseau99@gmail.com',
                'phone' => '0781726621',
                'password' => bcrypt('4rCJ6vZ9m4Yk5p'),
                'address' => '19 la croix quinquis',
                'zip_code' => '22290',
                'town' => 'pleguien',
                'client_id' => self::LERY_TECHNOLOGIES,
                'role_id' => self::SUPER_ADMIN
            ],
        ];
        try {
            foreach ($users as $user) {
                if (!User::where('email', $user['email'])->exists()) {
                    $createdUser = User::create($user);
                    // Les users deviennent des trainers
                    Trainer::create(['user_id' => $createdUser->id]);
                    with(new TwoColumnDetail($this->getOutput()))->render(
                        '<fg=yellow;options=bold>USER : </>'. $user['firstname'].' '.$user['lastname'],
                        '<fg=yellow;options=bold>ADDED</>'
                    );
                } else {
                    with(new TwoColumnDetail($this->getOutput()))->render(
                        '<fg=yellow;options=bold>USER : </>'.$user['firstname'].' '.$user['lastname'],
                        '<bg=red;options=bold>EXISTS</>'
                    );
                }
            }
        } catch (Exception $e) {
            with(new TwoColumnDetail($this->getOutput()))->render(
                '<fg=red;options=bold>Error: </>'. $e->getMessage(),
                '<fg=red;options=bold>Failed to insert users</>'
            );
            return Command::FAILURE;
        }
        return self::SUCCESS;
    }
}

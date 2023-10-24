<?php

namespace App\Repositories;

use App\Interfaces\LearnerInterface;
use App\Models\Learner;
use App\Models\Subclient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LearnerRepository implements LearnerInterface
{
    protected Learner $learner;

    public function __construct(Learner $learner)
    {
        $this->learner = $learner;
    }

    public function getLearnersBySubclient($subclientId): \Illuminate\Support\Collection
    {
        $subclient = Subclient::find($subclientId);
        return $subclient->learners;
    }

    public function createLearner(array $data): Learner
    {
        $user = new User([
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'zip_code' => $data['zip_code'],
            'town' => $data['town'],
            'password' => Hash::make(Str::random(10)),
        ]);

        $user->save();

        $learner = new Learner();
        $learner->user()->associate($user);
        $subClient = Subclient::findOrFail($data['subclient_id']);
        $learner->subclient()->associate($subClient);
        $learner->save();

        return $learner;
    }

}


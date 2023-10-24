<?php

namespace App\Repositories;

use App\Interfaces\TrainingInterface;
use App\Models\Offer;
use App\Models\Trainer;
use App\Models\Training;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TrainingRepository implements TrainingInterface
{
    protected Training $training;

    public function __construct(Training $training)
    {
        $this->training = $training;
    }

    public function getTrainingsByTrainerClientId($clientId): Collection
    {
        return Training::join('trainers', 'trainings.trainer_id', '=', 'trainers.id')
            ->join('users', 'trainers.user_id', '=', 'users.id')
            ->where('users.client_id', $clientId)
            ->with('center', 'learners')
            ->select('trainings.*')
            ->get();
    }

    public function createTraining(array $data): Training
    {
        $offer = Offer::where('name', 'Plus')->first();
        $trainer = Trainer::where('user_id', Auth::id())->first();

        $this->training->name = $data['training_name'];
        $this->training->center_id = $data['center_id'];
        $this->training->date = $data['training_date'];
        $this->training->offer_id = $offer->id;
        $this->training->trainer_id = $trainer->id;
        $this->training->save();

        return $this->training;
    }

    public function getTrainingById($id): ?Training
    {
        $training = Training::with(['center', 'lessons', 'lessons.learner', 'lessons.learner.subclient.company'])
            ->find($id);

        if (!$training) {
            return null;
        }
        return $training;
    }

    public function updateTraining($id, $data): ?Training
    {
        $training = Training::find($id);

        if (!$training) {
            return null;
        }

        $training->center_id = $data['center_id'];
        $training->name = $data['training_name'];
        $training->date = $data['training_date'];
        $training->save();
        return $training->fresh();
    }
}

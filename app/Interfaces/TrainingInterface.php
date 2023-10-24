<?php

namespace App\Interfaces;

use App\Models\Training;
use Illuminate\Database\Eloquent\Collection;

interface TrainingInterface
{
    public function getTrainingsByTrainerClientId($clientId): Collection;
    public function createTraining(array $data): Training;
    public function getTrainingById($id): ?Training;
    public function updateTraining($id, $data): ?Training;
}


<?php

namespace App\Interfaces;

use App\Models\Learner;
use Illuminate\Support\Collection;

interface LearnerInterface
{
    public function getLearnersBySubclient($subclientId): Collection;
    public function createLearner(array $data): Learner;
}

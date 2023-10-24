<?php

namespace App\Repositories;

use App\Http\Resources\LessonResource;
use App\Interfaces\LessonInterface;
use App\Models\Lesson;

class LessonRepository implements LessonInterface
{
    public function findById($id) : ?Lesson
    {
        return Lesson::find($id);
    }

    public function updateGridId(Lesson $lesson, $gridId): Lesson
    {
        $lesson->grid_id = $gridId;
        $lesson->save();

        return $lesson;
    }

    public function getFullLessonDetails($lessonId): LessonResource
    {
        $lesson = Lesson::with([
            'learner',
            'learner.vehicle',
            'learner.subclient',
            'grid',
            'grid.criteria',
            'grid.criteria.themes',
            'training',
            'training.center',
            'training.trainer.user',
        ])->find($lessonId);

        return new LessonResource($lesson);
    }
}

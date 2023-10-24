<?php

namespace App\Interfaces;

use App\Http\Resources\LessonResource;
use App\Models\Lesson;

interface LessonInterface
{
    public function findById($id): ?Lesson;
    public function updateGridId(Lesson $lesson, $gridId): Lesson;
    public function getFullLessonDetails($lessonId): LessonResource;
}

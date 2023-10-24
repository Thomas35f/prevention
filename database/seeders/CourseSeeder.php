<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Criterion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criteria = Criterion::factory(10)->create();
        Lesson::factory(10)->create()->each(function ($course) use ($criteria) {
            $course->criteria()->attach($criteria->random(2));
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Criterion;
use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriterionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themes = Theme::factory(5)->create();
        Criterion::factory(5)->create()->each(function ($criterion) use ($themes) {
            $criterion->themes()->attach($themes->random(2));
        });
    }
}

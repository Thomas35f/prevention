<?php

namespace Tests\Unit\Models;

use App\Models\Learner;
use App\Models\Lesson;
use App\Models\Grid;
use App\Models\Training;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fillable attributes.
     *
     * @return void
     */
    public function test_fillable_attributes(): void
    {
        $course = new Lesson([
            'observation' => 'Test Observation',
        ]);

        $this->assertEquals('Test Observation', $course->observation);
    }

    /**
     * Test grid relation.
     *
     * @return void
     */
    public function test_grid_relation(): void
    {
        $grid = Grid::factory()->create();
        $lesson = Lesson::factory()->create(['grid_id' => $grid->id]);

        $this->assertInstanceOf(Grid::class, $lesson->grid);
        $this->assertEquals($grid->id, $lesson->grid->id);
    }

    /**
     * Test training relation.
     *
     * @return void
     */
    public function test_training_relation(): void
    {
        $grid = Grid::factory()->create();
        $training = Training::factory()->create();
        $lesson = Lesson::factory()->create([
            'training_id' => $training->id,
            'grid_id' => $grid->id,
            'observation' => 'Some observation'
        ]);

        $this->assertInstanceOf(Training::class, $lesson->training);
        $this->assertEquals($training->id, $lesson->training->id);
    }

    /**
     * Test learner relation.
     *
     * @return void
     */
    public function test_learner_relation(): void
    {
        $learner = Learner::factory()->create();
        $lesson = Lesson::factory()->create(['learner_id' => $learner->id]);

        $this->assertInstanceOf(Learner::class, $lesson->learner);
        $this->assertEquals($learner->id, $lesson->learner->id);
    }
}

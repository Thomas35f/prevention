<?php

namespace Tests\Unit\Models;

use App\Models\Learner;
use App\Models\Lesson;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LearnerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test lessons relation.
     *
     * @return void
     */
    public function test_lessons_relation(): void
    {
        $learner = Learner::factory()->create();
        $lessons = Lesson::factory()->count(3)->create(['learner_id' => $learner->id]);

        // Vérifiez que la relation retourne une Collection de leçons
        $this->assertCount(3, $learner->lessons);
        foreach ($lessons as $lesson) {
            $this->assertContains($lesson->id, $learner->lessons->pluck('id'));
        }
    }

    /**
     * Test vehicle relation.
     *
     * @return void
     */
    public function test_vehicle_relation(): void
    {
        $learner = Learner::factory()->create();
        $vehicle = Vehicle::factory()->create(['learner_id' => $learner->id]);

        // Vérifiez que la relation retourne l'objet Vehicle correct
        $this->assertEquals($vehicle->id, $learner->vehicle->id);
    }

}

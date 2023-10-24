<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Training;
use App\Models\Learner;
use App\Models\Subclient;

class TrainerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $trainer = Trainer::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $trainer->user);
        $this->assertEquals($user->id, $trainer->user->id);
    }

    /** @test */
    public function it_has_many_trainings()
    {
        $trainer = Trainer::factory()->create();
        $training = Training::factory()->create(['trainer_id' => $trainer->id]);

        $this->assertInstanceOf(Training::class, $trainer->trainings->first());
        $this->assertEquals($training->id, $trainer->trainings->first()->id);
    }

    /** @test */
    public function it_has_many_subclients()
    {
        $trainer = Trainer::factory()->create();
        $subclient = Subclient::factory()->create();
        $trainer->subclients()->attach($subclient);

        $this->assertInstanceOf(Subclient::class, $trainer->subclients->first());
        $this->assertEquals($subclient->id, $trainer->subclients->first()->id);
    }
}

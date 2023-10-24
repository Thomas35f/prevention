<?php

namespace Tests\Unit\Models;

use App\Models\Criterion;
use App\Models\Grid;
use App\Models\Theme;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CriterionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fillable attributes.
     *
     * @return void
     */
    public function test_fillable_attributes(): void
    {
        $criterion = new Criterion([
            'label' => 'Test Text',
        ]);

        $this->assertEquals('Test Text', $criterion->label);
    }

    /**
     * Test grids relation.
     *
     * @return void
     */
    public function test_grids_relation(): void
    {
        $criterion = Criterion::factory()->create();
        $grid = Grid::factory()->create();

        $criterion->grids()->attach($grid->id);

        $this->assertInstanceOf(Grid::class, $criterion->grids->first());
        $this->assertEquals($grid->id, $criterion->grids->first()->id);
    }

    /**
     * Test themes relation.
     *
     * @return void
     */
    public function test_themes_relation(): void
    {
        $criterion = Criterion::factory()->create();
        $themes = Theme::factory()->count(3)->create();

        $criterion->themes()->attach($themes);

        $this->assertEquals(3, $criterion->themes->count());
        $this->assertInstanceOf(Theme::class, $criterion->themes->first());
    }

}


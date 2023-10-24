<?php

namespace Tests\Unit\Models;

use App\Models\Criterion;
use App\Models\Theme;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThemeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fillable attributes.
     *
     * @return void
     */
    public function test_fillable_attributes(): void
    {
        $theme = new Theme([
            'label' => 'Test Text',
        ]);

        $this->assertEquals('Test Text', $theme->label);
    }

    /**
     * Test criteria relation deletion.
     *
     * @return void
     */
    public function test_criteria_relation_deletion(): void
    {
        $theme = Theme::factory()->create();
        $criterion = Criterion::factory()->create();

        $theme->criteria()->attach($criterion->id);

        $this->assertContains($criterion->id, $theme->criteria()->pluck('id')->toArray());

        $theme->criteria()->detach($criterion->id);

        $this->assertNotContains($criterion->id, $theme->criteria()->pluck('id')->toArray());
    }

}



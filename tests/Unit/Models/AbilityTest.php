<?php

namespace Tests\Unit\Models;

use App\Models\Ability;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AbilityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fillable attributes.
     *
     * @return void
     */
    public function test_fillable_attributes(): void
    {
        $ability = new Ability([
            'name' => 'Some Ability',
            'description' => 'Description of the ability',
            'role_id' => 1,
        ]);

        $this->assertEquals('Some Ability', $ability->name);
        $this->assertEquals('Description of the ability', $ability->description);
        $this->assertEquals(1, $ability->role_id);
    }

    /**
     * Test the role relation.
     *
     * @return void
     */
    public function test_role_relation(): void
    {
        $role = Role::factory()->create();
        $ability = Ability::factory()->create(['role_id' => $role->id]);

        $this->assertInstanceOf(Role::class, $ability->role);
        $this->assertEquals($role->id, $ability->role->id);
    }

}

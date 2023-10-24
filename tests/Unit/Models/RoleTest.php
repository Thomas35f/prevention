<?php

namespace Tests\Unit\Models;

use App\Models\Ability;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fillable attributes.
     *
     * @return void
     */
    public function test_fillable_attributes(): void
    {
        $role = new Role([
            'name' => 'Admin',
            'description' => 'Administrator role'
        ]);

        $this->assertEquals('Admin', $role->name);
        $this->assertEquals('Administrator role', $role->description);
    }

    /**
     * Test users relation.
     *
     * @return void
     */
    public function test_users_relation(): void
    {
        $role = Role::factory()->create();
        User::factory()->count(3)->create(['role_id' => $role->id]);

        $this->assertEquals(3, $role->users->count());
        $this->assertInstanceOf(User::class, $role->users->first());
    }

    /**
     * Test abilities relation.
     *
     * @return void
     */
    public function test_abilities_relation(): void
    {
        $role = Role::factory()->create();
        Ability::factory()->count(3)->create(['role_id' => $role->id]);

        $this->assertEquals(3, $role->abilities->count());
        $this->assertInstanceOf(Ability::class, $role->abilities->first());
    }

}


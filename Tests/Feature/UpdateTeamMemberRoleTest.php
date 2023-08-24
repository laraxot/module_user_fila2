<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\TeamMemberManager;
use Livewire\Livewire;
use Modules\User\Models\User;
<<<<<<< HEAD
use Modules\User\Tests\TestCase;
=======
use Tests\TestCase;
>>>>>>> cf6505a (.)

class UpdateTeamMemberRoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
<<<<<<< HEAD
    public function teamMemberRolesCanBeUpdated(): void
=======
    public function team_member_roles_can_be_updated(): void
>>>>>>> cf6505a (.)
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(),
            ['role' => 'admin']
        );

        $component = Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->set('managingRoleFor', $otherUser)
            ->set('currentRole', 'editor')
            ->call('updateRole');

        $this->assertTrue($otherUser->fresh()->hasTeamRole(
            $user->currentTeam->fresh(),
            'editor'
        ));
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function onlyTeamOwnerCanUpdateTeamMemberRoles(): void
=======
    public function only_team_owner_can_update_team_member_roles(): void
>>>>>>> cf6505a (.)
    {
        $user = User::factory()->withPersonalTeam()->create();

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(),
            ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        $component = Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->set('managingRoleFor', $otherUser)
            ->set('currentRole', 'editor')
            ->call('updateRole')
            ->assertStatus(403);

        $this->assertTrue($otherUser->fresh()->hasTeamRole(
            $user->currentTeam->fresh(),
            'admin'
        ));
    }
}

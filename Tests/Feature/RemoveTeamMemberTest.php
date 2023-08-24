<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Modules\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\TeamMemberManager;
use Livewire\Livewire;
<<<<<<< HEAD
use Modules\User\Models\User;
<<<<<<< HEAD
use Modules\User\Tests\TestCase;
=======
=======
>>>>>>> d9f7748 (up)
use Tests\TestCase;
>>>>>>> cf6505a (.)

class RemoveTeamMemberTest extends TestCase
{
    use RefreshDatabase;

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function teamMembersCanBeRemovedFromTeams(): void
=======
    public function team_members_can_be_removed_from_teams(): void
>>>>>>> cf6505a (.)
=======
    public function test_team_members_can_be_removed_from_teams(): void
>>>>>>> d9f7748 (up)
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(),
            ['role' => 'admin']
        );

        $component = Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->set('teamMemberIdBeingRemoved', $otherUser->id)
            ->call('removeTeamMember');

        $this->assertCount(0, $user->currentTeam->fresh()->users);
    }

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function onlyTeamOwnerCanRemoveTeamMembers(): void
=======
    public function only_team_owner_can_remove_team_members(): void
>>>>>>> cf6505a (.)
=======
    public function test_only_team_owner_can_remove_team_members(): void
>>>>>>> d9f7748 (up)
    {
        $user = User::factory()->withPersonalTeam()->create();

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(),
            ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        $component = Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->set('teamMemberIdBeingRemoved', $user->id)
            ->call('removeTeamMember')
            ->assertStatus(403);
    }
}

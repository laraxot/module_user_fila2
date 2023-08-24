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

class LeaveTeamTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
<<<<<<< HEAD
    public function usersCanLeaveTeams(): void
=======
    public function users_can_leave_teams(): void
>>>>>>> cf6505a (.)
    {
        $user = User::factory()->withPersonalTeam()->create();

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(),
            ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        $component = Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->call('leaveTeam');

        $this->assertCount(0, $user->currentTeam->fresh()->users);
    }

    /**
     * @test
     */
<<<<<<< HEAD
    public function teamOwnersCantLeaveTheirOwnTeam(): void
=======
    public function team_owners_cant_leave_their_own_team(): void
>>>>>>> cf6505a (.)
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $component = Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->call('leaveTeam')
            ->assertHasErrors(['team']);

        $this->assertNotNull($user->currentTeam->fresh());
    }
}

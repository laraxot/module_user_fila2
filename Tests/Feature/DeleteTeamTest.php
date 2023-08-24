<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Modules\User\Models\Team;
use Modules\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\DeleteTeamForm;
use Livewire\Livewire;
<<<<<<< HEAD
use Modules\User\Models\Team;
use Modules\User\Models\User;
<<<<<<< HEAD
use Modules\User\Tests\TestCase;
=======
=======
>>>>>>> d9f7748 (up)
use Tests\TestCase;
>>>>>>> cf6505a (.)

class DeleteTeamTest extends TestCase
{
    use RefreshDatabase;

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function teamsCanBeDeleted(): void
=======
    public function teams_can_be_deleted(): void
>>>>>>> cf6505a (.)
=======
    public function test_teams_can_be_deleted(): void
>>>>>>> d9f7748 (up)
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $user->ownedTeams()->save($team = Team::factory()->make([
            'personal_team' => false,
        ]));

        $team->users()->attach(
            $otherUser = User::factory()->create(),
            ['role' => 'test-role']
        );

        $component = Livewire::test(DeleteTeamForm::class, ['team' => $team->fresh()])
            ->call('deleteTeam');

        $this->assertNull($team->fresh());
        $this->assertCount(0, $otherUser->fresh()->teams);
    }

<<<<<<< HEAD
    /**
     * @test
     */
<<<<<<< HEAD
    public function personalTeamsCantBeDeleted(): void
=======
    public function personal_teams_cant_be_deleted(): void
>>>>>>> cf6505a (.)
=======
    public function test_personal_teams_cant_be_deleted(): void
>>>>>>> d9f7748 (up)
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $component = Livewire::test(DeleteTeamForm::class, ['team' => $user->currentTeam])
            ->call('deleteTeam')
            ->assertHasErrors(['team']);

        $this->assertNotNull($user->currentTeam->fresh());
    }
}

<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateTeamNameForm;
use Livewire\Livewire;
use Modules\User\Models\User;
<<<<<<< HEAD
use Modules\User\Tests\TestCase;
=======
use Tests\TestCase;
>>>>>>> cf6505a (.)

class UpdateTeamNameTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
<<<<<<< HEAD
    public function teamNamesCanBeUpdated(): void
=======
    public function team_names_can_be_updated(): void
>>>>>>> cf6505a (.)
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        Livewire::test(UpdateTeamNameForm::class, ['team' => $user->currentTeam])
            ->set(['state' => ['name' => 'Test Team']])
            ->call('updateTeamName');

        $this->assertCount(1, $user->fresh()->ownedTeams);
        $this->assertEquals('Test Team', $user->currentTeam->fresh()->name);
    }
}

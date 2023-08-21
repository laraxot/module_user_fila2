<<<<<<< HEAD
<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateTeamNameForm;
use Livewire\Livewire;
use Modules\User\Models\User;
use Tests\TestCase;

class UpdateTeamNameTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function teamNamesCanBeUpdated(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        Livewire::test(UpdateTeamNameForm::class, ['team' => $user->currentTeam])
            ->set(['state' => ['name' => 'Test Team']])
            ->call('updateTeamName');

        $this->assertCount(1, $user->fresh()->ownedTeams);
        $this->assertEquals('Test Team', $user->currentTeam->fresh()->name);
    }
}
=======
<?php

namespace Modules\User\Tests\Feature;

use Modules\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateTeamNameForm;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateTeamNameTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_names_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        Livewire::test(UpdateTeamNameForm::class, ['team' => $user->currentTeam])
            ->set(['state' => ['name' => 'Test Team']])
            ->call('updateTeamName');

        $this->assertCount(1, $user->fresh()->ownedTeams);
        $this->assertEquals('Test Team', $user->currentTeam->fresh()->name);
    }
}
>>>>>>> d1783f5 (up)

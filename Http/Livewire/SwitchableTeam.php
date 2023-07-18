<?php

namespace Modules\User\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use Modules\User\FilamentJet;
use Filament\Facades\Filament;
use Modules\User\Events\TeamSwitched;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;
use Modules\User\Http\Livewire\Traits\Properties\HasUserProperty;

class SwitchableTeam extends Component
{
    use HasUserProperty;

    public Collection $teams;

    public function mount(): void
    {
        $this->teams = Filament::auth()->user()->allTeams();
    }

    /**
     * Update the authenticated user's current team.
     *
     * @param $teamId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function switchTeam($teamId)
    {
        $team = FilamentJet::newTeamModel()->findOrFail($teamId);

        if (! $this->user->switchTeam($team)) {
            abort(403);
        }

        TeamSwitched::dispatch($team->fresh(), $this->user);

        Notification::make()
            ->title(__('Team switched'))
            ->success()
            ->send();

        return redirect(config('filament.path'), 303);
    }

    public function render(): View
    {
        return view('filament-jet::components.switchable-team');
    }
}
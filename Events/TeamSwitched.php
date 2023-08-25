<?php

declare(strict_types=1);

namespace Modules\User\Events;

use Illuminate\Foundation\Events\Dispatchable;
use ArtMin96\FilamentJet\Contracts\TeamContract;
use ArtMin96\FilamentJet\Contracts\UserContract;

class TeamSwitched
{
    use Dispatchable;

     /**
     * The team instance.
     *
     */
    public TeamContract $team;

    /**
     * The team member that was updated.
     *
     */
    public UserContract $user;



    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TeamContract $team,UserContract $user)
    {
        $this->team = $team;
        $this->user = $user;
    }
}

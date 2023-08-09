<?php

namespace Modules\User\Events;

use Illuminate\Foundation\Events\Dispatchable;
use ArtMin96\FilamentJet\Contracts\TeamContract;

class InvitingTeamMember
{
    use Dispatchable;


     /**
     * The team instance.
     *
     */
    public TeamContract $team;

     /**
     * The team member being added.
     *
     */
    public string $email;

    /**
     * The role of the invitee.
     *
     */
    public string $role;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TeamContract $team,string $email,string $role)
    {
        $this->team = $team;
        $this->email = $email;
        $this->role = $role;
    }
}

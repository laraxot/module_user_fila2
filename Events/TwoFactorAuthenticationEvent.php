<?php

namespace Modules\User\Events;

use Illuminate\Foundation\Events\Dispatchable;
use ArtMin96\FilamentJet\Contracts\TeamContract;
use ArtMin96\FilamentJet\Contracts\UserContract;

abstract class TwoFactorAuthenticationEvent
{
    use Dispatchable;

    /**
     * The team member being added.
     *
     */
    public UserContract $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UserContract $user)
    {
        $this->user = $user;
    }
}

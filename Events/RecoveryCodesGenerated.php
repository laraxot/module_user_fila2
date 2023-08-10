<?php

namespace Modules\User\Events;

use Illuminate\Foundation\Events\Dispatchable;
use ArtMin96\FilamentJet\Contracts\UserContract;

class RecoveryCodesGenerated
{
    use Dispatchable;

    /**
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

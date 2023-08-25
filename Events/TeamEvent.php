<?php

declare(strict_types=1);

namespace Modules\User\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use ArtMin96\FilamentJet\Contracts\TeamContract;
use Illuminate\Broadcasting\InteractsWithSockets;

abstract class TeamEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * The team instance.
     *
     */
    public TeamContract $team;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TeamContract $team)
    {
        $this->team = $team;
    }
}

<?php

declare(strict_types=1);

namespace Modules\User\Mail;

use Modules\User\Models\TeamInvitation as TeamInvitationModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class TeamInvitation extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * The team invitation instance.
     */
    public TeamInvitationModel $invitation;
<<<<<<< HEAD
=======

<<<<<<< HEAD
>>>>>>> cf6505a (.)
=======



>>>>>>> d9f7748 (up)
}

<<<<<<< HEAD
<?php

declare(strict_types=1);

namespace Modules\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\User\Models\TeamInvitation as TeamInvitationModel;

class TeamInvitation extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * The team invitation instance.
     */
    public TeamInvitationModel $invitation;
}
=======
<?php

namespace Modules\User\Mail;

use Modules\User\Models\TeamInvitation as TeamInvitationModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class TeamInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The team invitation instance.
     */
    public TeamInvitationModel $invitation;




}
>>>>>>> d1783f5 (up)

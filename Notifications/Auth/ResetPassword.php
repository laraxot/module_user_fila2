<<<<<<< HEAD
<?php

declare(strict_types=1);

namespace Modules\User\Notifications\Auth;

use Illuminate\Auth\Notifications\ResetPassword as BaseNotification;

class ResetPassword extends BaseNotification
{
    public string $url;

    protected function resetUrl($notifiable): string
    {
        return $this->url;
    }
}
=======
<?php

namespace Modules\User\Notifications\Auth;

use Illuminate\Auth\Notifications\ResetPassword as BaseNotification;

class ResetPassword extends BaseNotification
{
    public string $url;

    protected function resetUrl($notifiable): string
    {
        return $this->url;
    }
}
>>>>>>> d1783f5 (up)

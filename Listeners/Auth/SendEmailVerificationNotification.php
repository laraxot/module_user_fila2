<?php

namespace Modules\User\Listeners\Auth;

use Modules\User\FilamentJet;
use Modules\User\Notifications\Auth\VerifyEmail;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification as BaseListener;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class SendEmailVerificationNotification extends BaseListener
{
    public function handle(Registered $event): void
    {
        if (! $event->user instanceof MustVerifyEmail) {
            return;
        }

        if ($event->user->hasVerifiedEmail()) {
            return;
        }

        if (! method_exists($event->user, 'notify')) {
            $userClass = $event->user::class;

            throw new Exception("Model [{$userClass}] does not have a [notify()] method.");
        }

        $notification = new VerifyEmail();
        $notification->url = FilamentJet::getVerifyEmailUrl($event->user);

        $event->user->notify($notification);
    }
}

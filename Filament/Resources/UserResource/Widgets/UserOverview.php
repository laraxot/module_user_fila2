<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class UserOverview extends Widget
{
<<<<<<< HEAD
=======
    protected static string $view = 'user::filament.resources.user-resource.widgets.user-overview';

>>>>>>> cf6505a (.)
    public ?Model $record = null;

    protected static string $view = 'user::filament.resources.user-resource.widgets.user-overview';
}

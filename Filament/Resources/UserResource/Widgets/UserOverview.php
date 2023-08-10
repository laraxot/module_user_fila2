<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class UserOverview extends Widget
{
    protected static string $view = 'user::filament.resources.user-resource.widgets.user-overview';

    public ?Model $record = null;
}

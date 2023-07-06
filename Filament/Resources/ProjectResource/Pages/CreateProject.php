<?php

namespace Modules\User\Filament\Resources\ProjectResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\User\Filament\Resources\ProjectResource;
use Savannabits\FilamentModules\Concerns\ContextualPage;

class CreateProject extends CreateRecord
{
    use ContextualPage;
    protected static string $resource = ProjectResource::class;
}

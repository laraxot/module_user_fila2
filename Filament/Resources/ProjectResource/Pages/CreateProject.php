<?php

namespace Modules\User\Filament\Resources\ProjectResource\Pages;

use Modules\User\Filament\Resources\ProjectResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;
}

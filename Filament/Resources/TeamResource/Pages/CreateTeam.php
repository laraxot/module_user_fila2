<?php

namespace Modules\User\Filament\Resources\TeamResource\Pages;


use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\User\Filament\Resources\TeamResource;

class CreateTeam extends CreateRecord
{
    protected static string $resource = TeamResource::class;
}

<?php

namespace Modules\User\Filament\Resources\RoleResource\Pages;

use RoleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;
}

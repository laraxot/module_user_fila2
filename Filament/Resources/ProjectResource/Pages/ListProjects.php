<?php

namespace Modules\User\Filament\Resources\ProjectResource\Pages;

use Modules\User\Filament\Resources\ProjectResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

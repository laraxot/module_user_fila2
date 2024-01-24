<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\User\Filament\Resources\UserResource;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UserResource\Widgets\UserOverview::class,
        ];
    }
}

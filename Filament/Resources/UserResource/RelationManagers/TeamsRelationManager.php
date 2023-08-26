<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Modules\User\Filament\Resources\TeamResource;
use Filament\Resources\RelationManagers\RelationManager;

class TeamsRelationManager extends RelationManager
{
    protected static string $relationship = 'teams';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return TeamResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return TeamResource::table($table);
    }
}

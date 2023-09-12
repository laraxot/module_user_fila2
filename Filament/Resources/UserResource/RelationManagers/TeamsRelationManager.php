<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\AttachAction;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\User\Filament\Resources\TeamResource;
use Modules\User\Models\Role;

class TeamsRelationManager extends RelationManager
{
    protected static string $relationship = 'teams';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        $form = TeamResource::form($form);
        $childComponents = [];
        foreach ($form->getSchema() as $schema) {
            $childComponents = array_merge($childComponents, $schema->getChildComponents());
        }
        
        $childComponents['role'] = Select::make('role')
             ->options(Role::all()->pluck('name', 'name'));
        $form->schema($childComponents);

        return $form;
    }

    public static function table(Table $table): Table
    {
        $table = TeamResource::table($table);

        $columns = $table->getColumns();
        $columns['role'] = TextColumn::make('role');
        $table->columns($columns);

        $headerActions = $table->getHeaderActions();
        $headerActions['attach'] = AttachAction::make()
            ->form(static fn(AttachAction $attachAction): array => [
                $attachAction->getRecordSelect(),
                Select::make('role')
                    ->options(Role::all()->pluck('name', 'name')),
            ]);
        $table->headerActions($headerActions);

        return $table;
    }
}

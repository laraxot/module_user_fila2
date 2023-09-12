<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Columns\TextColumn;
use Modules\User\Filament\Resources\TeamResource;
use Modules\User\Models\Role;

class TeamsRelationManager extends RelationManager
{
    protected static string $relationship = 'teams';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
           ->schema([
               TextInput::make('name')
                   ->required()
                   ->maxLength(255),
           ]);
        /*
        $form = TeamResource::form($form);
        $childComponents = [];
        foreach ($form->getSchema() as $schema) {
            $childComponents = array_merge($childComponents, $schema->getChildComponents());
        }

        $childComponents['role'] = Select::make('role')
             ->options(Role::all()->pluck('name', 'name'));
        $form->schema($childComponents);

        return $form;
        */
    }

    public static function table(Table $table): Table
    {
        $table = TeamResource::table($table);

        $columns = $table->getColumns();
        $columns['role'] = TextColumn::make('role');
        $table->columns($columns);

        $headerActions = $table->getHeaderActions();

        $headerActions['attach'] = AttachAction::make()

            ->form(fn (AttachAction $action): array => [
                $action->getRecordSelect(),
                Select::make('role')
                    ->options(Role::all()->pluck('name', 'name')),
            ]);

        // ->form(fn(...$args) => dddx($args));

        $table->headerActions($headerActions);

        return $table;
    }

    public static function tableNew(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                // Tables\Actions\AssociateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DissociateAction::make(),
                Tables\Actions\DetachAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DissociateBulkAction::make(),
                // Tables\Actions\DetachBulkAction::make(),
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}

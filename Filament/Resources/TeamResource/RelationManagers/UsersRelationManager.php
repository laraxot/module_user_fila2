<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\TeamResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Modules\User\Filament\Resources\UserResource;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';
    
    protected static ?string $inverseRelationship = 'teams';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        $form = UserResource::form($form);

        return $form;
        /*
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
        */
    }

    public static function table(Table $table): Table
    {
        $table = UserResource::table($table);
        $columns = $table->getColumns();
        $columns = collect($columns)->except(['teams.name', 'role.name', 'roles.name'])->all();
        $columns['role'] = TextColumn::make('role');
        $table->columns($columns);
        $headerActions = $table->getHeaderActions();
        // $headerActions['attach']=Tables\Actions\AttachAction::make();
        $table->headerActions($headerActions);

        return $table;
        /*
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
        */
    }
}

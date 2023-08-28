<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources;

use ArtMin96\FilamentJet\FilamentJet;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\User\Filament\Resources\TeamResource\Pages;
use Modules\User\Filament\Resources\TeamResource\RelationManagers;
use Modules\User\Models\Role;
use Savannabits\FilamentModules\Concerns\ContextualResource;

class TeamResource extends Resource
{
    use ContextualResource;
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'Teams';
    protected static ?string $slug = 'teams';
    protected static ?string $navigationGroup = 'Admin';

    public static function getModel(): string
    {
        return FilamentJet::teamModel();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                'name' => Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                // 'role'=>Forms\Components\Select::make('role')
                //    ->options(Role::all()->pluck('name', 'name')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                'id' => Tables\Columns\TextColumn::make('id'),
                'name' => Tables\Columns\TextColumn::make('name'),
                // Tables\Columns\TextColumn::make('role'),
            ])
            ->filters([
            ])
            ->headerActions([
                // 'create' => Tables\Actions\CreateAction::make(),
                // Tables\Actions\AssociateAction::make(),
                // Tables\Actions\AttachAction::make()

                // ->form(fn (Tables\Actions\AttachAction $action): array => [
                //     $action->getRecordSelect(),
                //     // Forms\Components\TextInput::make('role')->required(),
                //     Forms\Components\Select::make('role_id')
                //         ->options(Role::all()->pluck('name', 'id'))
                // ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DissociateAction::make(),
                // Tables\Actions\DetachAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DissociateBulkAction::make(),
                // Tables\Actions\DetachBulkAction::make(),
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'view' => Pages\ViewTeam::route('/{record}'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return strval(static::getModel()::count());
    }
}

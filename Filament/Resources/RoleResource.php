<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources;

use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\User\Filament\Resources\RoleResource\Pages;
use Modules\User\Models\ModelHasRole;
use Savannabits\FilamentModules\Concerns\ContextualResource;

class RoleResource extends Resource
{
    use ContextualResource;
    protected static ?string $model = ModelHasRole::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'view' => Pages\ViewRole::route('/{record}'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return strval(static::getModel()::count());
    }
}

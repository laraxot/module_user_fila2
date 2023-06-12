<?php

namespace Modules\User\Filament\Resources;

use Modules\User\Filament\Resources\UserResource\Pages;
use Modules\User\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Savannabits\FilamentModules\Concerns\ContextualResource;
use Illuminate\Validation\Rules\Password;
use Modules\User\Models\Role;

class UserResource extends Resource
{
    use ContextualResource;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(),
                //Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->rule(Password::default()),
                    /*
                Forms\Components\TextInput::make('role_id')
                    ->required(),
                Forms\Components\TextInput::make('display_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('phone_verified_at'),
                Forms\Components\TextInput::make('photo')
                    ->maxLength(255),
                    */
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                //Tables\Columns\TextColumn::make('email'),
                //Tables\Columns\TextColumn::make('email_verified_at')
                //    ->dateTime(),
                Tables\Columns\TextColumn::make('role.name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                //Tables\Columns\TextColumn::make('updated_at')
                //    ->dateTime(),
                //Tables\Columns\TextColumn::make('role_id'),
                //Tables\Columns\TextColumn::make('display_name'),
                //Tables\Columns\TextColumn::make('phone_number'),
                //Tables\Columns\TextColumn::make('phone_verified_at')
                //    ->dateTime(),
                //Tables\Columns\TextColumn::make('photo'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role') 
                ->options([
                    Role::ROLE_USER => 'User',
                    Role::ROLE_OWNER => 'Owner',
                    Role::ROLE_ADMINISTRATOR => 'Administrator',
                ])
                ->attribute('role_id'), 
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('changePassword') 
                    ->action(function (User $record, array $data): void {
                        $record->update([
                            'password' => Hash::make($data['new_password']),
                        ]);
 
                        Filament::notify('success', 'Password changed successfully.');
                    })
                    ->form([
                        Forms\Components\TextInput::make('new_password')
                            ->password()
                            ->label('New Password')
                            ->required()
                            ->rule(Password::default()),
                        Forms\Components\TextInput::make('new_password_confirmation')
                            ->password()
                            ->label('Confirm New Password')
                            ->rule('required', fn($get) => ! ! $get('new_password'))
                            ->same('new_password'),
                    ])
                    ->icon('heroicon-o-key')
                    //->visible(fn (User $record): bool => $record->role_id === Role::ROLE_ADMINISTRATOR)
                    ,
                Tables\Actions\Action::make('deactivate')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->action(fn (User $record) => $record->delete())
                    //->visible(fn (User $record): bool => $record->role_id === Role::ROLE_ADMINISTRATOR)
                    , 
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc'); 
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            //'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}

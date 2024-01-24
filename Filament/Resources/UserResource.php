<?php
/**
 * @see https://github.com/ryangjchandler/filament-user-resource/blob/main/src/Resources/UserResource.php
 * @see https://github.com/3x1io/filament-user/blob/main/src/Resources/UserResource.php
 */

declare(strict_types=1);

namespace Modules\User\Filament\Resources;

use Closure;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Modules\User\Models\Role;
use Modules\User\Models\User;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Validation\Rules\Password;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\User\Filament\Resources\UserResource\Pages;
use Modules\User\Filament\Resources\UserResource\Widgets;
use Savannabits\FilamentModules\Concerns\ContextualResource;
use Modules\User\Filament\Resources\UserResource\Pages\CreateUser;
use Modules\User\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    use ContextualResource;
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static bool|\Closure $enablePasswordUpdates = true;

    protected static \Closure|null $extendFormCallback = null;

    /*
    protected static function getNavigationLabel(): string
    {
        return trans('filament-user::user.resource.label');
    }

    public static function getPluralLabel(): string
    {
        return trans('filament-user::user.resource.label');
    }

    public static function getLabel(): string
    {
        return trans('filament-user::user.resource.single');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('filament-user.group');
    }

    protected function getTitle(): string
    {
        return trans('filament-user::user.resource.title.resource');
    }
    */

    protected static function getNavigationBadge(): ?string
    {
        return strval(static::getModel()::count());
    }

    public static function getWidgets(): array
    {
        return [
            Widgets\UserOverview::class,
        ];
    }

    public static function extendForm(\Closure $callback): void
    {
        static::$extendFormCallback = $callback;
    }

    public static function formOld(Form $form): Form
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
                Forms\Components\Select::make('roles')
                    ->multiple()
                    ->relationship('roles', 'name'),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(function () {
                $schema = [
                    'left' => Card::make([
                        'name' => TextInput::make('name')
                            ->required(),
                        'email' => TextInput::make('email')
                            ->required()
                            ->unique(ignoreRecord: true),
                        'password' => TextInput::make('password')
                            ->required()
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            /*
                            ->dehydrateStateUsing(static function ($state) use ($form){
                                if(!empty($state)){
                                    return Hash::make($state);
                                }

                                $user = User::find($form->getColumns());
                                if($user){
                                    return $user->password;
                                }
                            }),
                            */
                            ->visible(fn ($livewire) => $livewire instanceof CreateUser)
                            ->rule(Password::default()),
                        'new_password_group' => Group::make([
                            'new_password' => TextInput::make('new_password')
                                ->password()
                                ->label('New Password')
                                ->nullable()
                                ->rule(Password::default())
                                ->dehydrated(false),
                            'new_password_confirmation' => TextInput::make('new_password_confirmation')
                                ->password()
                                ->label('Confirm New Password')
                                ->rule('required', fn ($get) => (bool) $get('new_password'))
                                ->same('new_password')
                                ->dehydrated(false),
                        ])->visible(static::$enablePasswordUpdates),
                    ])->columnSpan(8),
                    'right' => Card::make([
                        'created_at' => Placeholder::make('created_at')
                            ->content(fn ($record) => $record?->created_at?->diffForHumans() ?? new HtmlString('&mdash;')),
                    ])->columnSpan(4),
                ];

                if (null !== static::$extendFormCallback) {
                    $schema = value(static::$extendFormCallback, $schema);
                }

                return $schema;
            })
            ->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable()->toggleable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('profile.first_name')->label('first name')->sortable()->searchable()->toggleable(),
                TextColumn::make('profile.last_name')->label('last name')->sortable()->searchable()->toggleable(),
                TextColumn::make('teams.name')->sortable()->searchable()->toggleable(),
                // Tables\Columns\TextColumn::make('email'),
                // Tables\Columns\TextColumn::make('email_verified_at')
                //    ->dateTime(),
                TextColumn::make('role.name')->toggleable(),
                TextColumn::make('roles.name')->toggleable(),
                // Tables\Columns\TextColumn::make('created_at')->dateTime(),
                // Tables\Columns\TextColumn::make('updated_at')
                //    ->dateTime(),
                // Tables\Columns\TextColumn::make('role_id'),
                // Tables\Columns\TextColumn::make('display_name'),
                // Tables\Columns\TextColumn::make('phone_number'),
                // Tables\Columns\TextColumn::make('phone_verified_at')
                //    ->dateTime(),
                // Tables\Columns\TextColumn::make('photo'),
                BooleanColumn::make('email_verified_at')->sortable()->searchable()->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                ->options([
                    Role::ROLE_USER => 'User',
                    Role::ROLE_OWNER => 'Owner',
                    Role::ROLE_ADMINISTRATOR => 'Administrator',
                ])
                ->attribute('role_id'),
                Tables\Filters\Filter::make('verified')
                    ->label(trans('filament-user::user.resource.verified'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Tables\Filters\Filter::make('unverified')
                    ->label(trans('filament-user::user.resource.unverified'))
                    ->query(fn (Builder $query): Builder => $query->whereNull('email_verified_at')),
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
                            ->rule('required', fn ($get) => (bool) $get('new_password'))
                            ->same('new_password'),
                    ])
                    ->icon('heroicon-o-key')
                // ->visible(fn (User $record): bool => $record->role_id === Role::ROLE_ADMINISTRATOR)
                ,
                Tables\Actions\Action::make('deactivate')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->action(fn (User $record) => $record->delete())
                // ->visible(fn (User $record): bool => $record->role_id === Role::ROLE_ADMINISTRATOR)
                ,
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
             ->defaultSort('created_at', 'desc');
    }

    public static function enablePasswordUpdates(bool|\Closure $condition = true): void
    {
        static::$enablePasswordUpdates = $condition;
    }

    /*
    public static function getModel(): string
    {
        return config('filament-user-resource.model');
    }
    */

    public static function getRelations(): array
    {
        return [
            RelationManagers\TeamsRelationManager::class,
            RelationManagers\ProfileRelationManager::class,
            RelationManagers\RolesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

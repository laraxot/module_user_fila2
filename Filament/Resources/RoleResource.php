<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\User\Facades\FilamentShield;
use Modules\User\Filament\Resources\RoleResource\Pages;
use Modules\User\Filament\Resources\RoleResource\RelationManagers;
use Modules\User\Models\Role;
use Modules\User\Support\Utils;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Savannabits\FilamentModules\Concerns\ContextualResource;

class RoleResource extends XotBaseResource
{ /* implements HasShieldPermissions */
    // use ContextualResource;
    protected static ?string $model = Role::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?Collection $permissionsCollection = null;

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(static::trans('fields.name'))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Select::make('team_id')
                                    ->relationship('team', 'name'),
                                Forms\Components\TextInput::make('guard_name')
                                    ->label(static::trans('fields.guard_name'))
                                    ->default(Utils::getFilamentAuthGuard())
                                    ->nullable()
                                    ->maxLength(255),
                                Forms\Components\Toggle::make('select_all')
                                    ->onIcon('heroicon-s-shield-check')
                                    ->offIcon('heroicon-s-shield-exclamation')
                                    ->label(static::trans('fields.select_all.name'))
                                    ->helperText(static::trans('fields.select_all.message'))
                                    ->reactive()
                                    ->afterStateUpdated(function (\Closure $set, $state) {
                                        static::refreshEntitiesStatesViaSelectAll($set, $state);
                                    })
                                    ->dehydrated(fn ($state): bool => $state),
                            ])
                            ->columns([
                                'sm' => 2,
                                'lg' => 3,
                            ]),
                    ]),
                Forms\Components\Tabs::make('Permissions')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make(static::trans('resources'))
                            ->visible(fn (): bool => (bool) Utils::isResourceEntityEnabled())
                            ->reactive()
                            ->schema([
                                Forms\Components\Grid::make([
                                    'sm' => 2,
                                    'lg' => 3,
                                ])
                                    ->schema(static::getResourceEntitiesSchema())
                                    ->columns([
                                        'sm' => 2,
                                        'lg' => 3,
                                    ]),
                            ]),
                        Forms\Components\Tabs\Tab::make(static::trans('pages'))
                            // ->visible(fn (): bool => (bool) Utils::isPageEntityEnabled() && (count(FilamentShield::getPages()) > 0 ? true : false))
                            ->reactive()
                            ->schema([
                                Forms\Components\Grid::make([
                                    'sm' => 3,
                                    'lg' => 4,
                                ])
                                    ->schema(static::getPageEntityPermissionsSchema())
                                    ->columns([
                                        'sm' => 3,
                                        'lg' => 4,
                                    ]),
                            ]),
                        Forms\Components\Tabs\Tab::make(static::trans('widgets'))
                            // ->visible(fn (): bool => (bool) Utils::isWidgetEntityEnabled() && (count(FilamentShield::getWidgets()) > 0 ? true : false))
                            ->reactive()
                            ->schema([
                                Forms\Components\Grid::make([
                                    'sm' => 3,
                                    'lg' => 4,
                                ])
                                    ->schema(static::getWidgetEntityPermissionSchema())
                                    ->columns([
                                        'sm' => 3,
                                        'lg' => 4,
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make(static::trans('custom'))
                            ->visible(fn (): bool => (bool) Utils::isCustomPermissionEntityEnabled())
                            ->reactive()
                            ->schema([
                                Forms\Components\Grid::make([
                                    'sm' => 3,
                                    'lg' => 4,
                                ])
                                    ->schema(static::getCustomEntitiesPermisssionSchema())
                                    ->columns([
                                        'sm' => 3,
                                        'lg' => 4,
                                    ]),
                            ]),
                    ])
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('name')
                    ->label(static::trans('fields.name'))
                    ->formatStateUsing(fn ($state): string => Str::headline($state))
                    ->colors(['primary'])
                    ->searchable(),
                // Tables\Columns\TextColumn::make('team_id'),
                Tables\Columns\TextColumn::make('team.name'),
                Tables\Columns\BadgeColumn::make('guard_name')
                    ->label(static::trans('fields.guard_name')),
                Tables\Columns\BadgeColumn::make('permissions_count')
                    ->label(static::trans('fields.permissions'))
                    ->counts('permissions')
                    ->colors(['success']),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(static::trans('fields.updated_at'))
                    ->dateTime(),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'view' => Pages\ViewRole::route('/{record}'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    public static function getModel(): string
    {
        return Utils::getRoleModel();
    }

    public static function canGloballySearch(): bool
    {
        return Utils::isResourceGloballySearchable() && count(static::getGloballySearchableAttributes()) && static::canViewAny();
    }

    /*--------------------------------*
    | Resource Related Logic Start     |
    *----------------------------------*/

    public static function getResourceEntitiesSchema(): array
    {
        if (blank(static::$permissionsCollection)) {
            static::$permissionsCollection = Utils::getPermissionModel()::all();
        }

        /*
        dddx(['FilamentShield::getResources()' => FilamentShield::getResources(),
            'Filament::getResources()' => Filament::getResources(),
        ]);

        return [];
        */
        return [];

        return collect(FilamentShield::getResources())->sortKeys()->reduce(function ($entities, $entity) {
            $entities[] = Forms\Components\Card::make()
                ->extraAttributes(['class' => 'border-0 shadow-lg'])
                ->schema([
                    Forms\Components\Toggle::make($entity['resource'])
                        ->label(FilamentShield::getLocalizedResourceLabel($entity['fqcn']))
                        // ->helperText(Utils::showModelPath($entity['fqcn']))
                        ->onIcon('heroicon-s-lock-open')
                        ->offIcon('heroicon-s-lock-closed')
                        ->reactive()
                        ->afterStateUpdated(function (\Closure $set, \Closure $get, $state) use ($entity) {
                            collect(Utils::getResourcePermissionPrefixes($entity['fqcn']))->each(function ($permission) use ($set, $entity, $state) {
                                $set($permission.'_'.$entity['resource'], $state);
                            });

                            if (! $state) {
                                $set('select_all', false);
                            }

                            static::refreshSelectAllStateViaEntities($set, $get);
                        })
                        ->dehydrated(false),
                    Forms\Components\Fieldset::make('Permissions')
                        ->label(static::trans('fields.permissions'))
                        ->extraAttributes(['class' => 'text-primary-600', 'style' => 'border-color:var(--primary)'])
                        ->columns([
                            'default' => 2,
                            'xl' => 2,
                        ])
                        ->schema(static::getResourceEntityPermissionsSchema($entity)),
                ])
                ->columnSpan(1);

            return $entities;
        }, collect())
            ->toArray();
    }

    public static function getResourceEntityPermissionsSchema($entity): ?array
    {
        return collect(Utils::getResourcePermissionPrefixes($entity['fqcn']))->reduce(function ($permissions /* @phpstan ignore-line */, $permission) use ($entity) {
            $permissions[] = Forms\Components\Checkbox::make($permission.'_'.$entity['resource'])
                ->label(FilamentShield::getLocalizedResourcePermissionLabel($permission))
                ->extraAttributes(['class' => 'text-primary-600'])
                ->afterStateHydrated(function (\Closure $set, \Closure $get, $record) use ($entity, $permission) {
                    if (is_null($record)) {
                        return;
                    }

                    $set($permission.'_'.$entity['resource'], $record->checkPermissionTo($permission.'_'.$entity['resource']));

                    static::refreshResourceEntityStateAfterHydrated($record, $set, $entity);

                    static::refreshSelectAllStateViaEntities($set, $get);
                })
                ->reactive()
                ->afterStateUpdated(function (\Closure $set, \Closure $get, $state) use ($entity) {
                    static::refreshResourceEntityStateAfterUpdate($set, $get, $entity);

                    if (! $state) {
                        $set($entity['resource'], false);
                        $set('select_all', false);
                    }

                    static::refreshSelectAllStateViaEntities($set, $get);
                })
                ->dehydrated(fn ($state): bool => $state);

            return $permissions;
        }, collect())
            ->toArray();
    }

    /*
    public static function getModelLabel(): string
    {
        return static::trans('resource.label.role');
    }


    public static function getPluralModelLabel(): string
    {
        return static::trans('resource.label.roles');
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return Utils::isResourceNavigationRegistered();
    }

    protected static function getNavigationGroup(): ?string
    {
        return Utils::isResourceNavigationGroupEnabled()
            ? static::trans('nav.group')
            : '';
    }

    protected static function getNavigationLabel(): string
    {
        return static::trans('nav.role.label');
    }

    protected static function getNavigationIcon(): string
    {
        return static::trans('nav.role.icon');
    }

    protected static function getNavigationSort(): ?int
    {
        return Utils::getResourceNavigationSort();
    }

    public static function getSlug(): string
    {
        return Utils::getResourceSlug();
    }
    */

    protected static function getNavigationBadge(): ?string
    {
        return Utils::isResourceNavigationBadgeEnabled()
            ? strval(static::getModel()::count())
            : null;
    }

    protected static function refreshSelectAllStateViaEntities(\Closure $set, \Closure $get): void
    {
        $entitiesStates = collect(FilamentShield::getResources())
            ->when(Utils::isPageEntityEnabled(), fn ($entities) => $entities->merge(FilamentShield::getPages()))
            ->when(Utils::isWidgetEntityEnabled(), fn ($entities) => $entities->merge(FilamentShield::getWidgets()))
            ->when(Utils::isCustomPermissionEntityEnabled(), fn ($entities) => $entities->merge(static::getCustomEntities()))
            ->map(function ($entity) use ($get) {
                if (is_array($entity)) {
                    return (bool) $get($entity['resource']);
                }

                return (bool) $get($entity);
            });

        if (false === $entitiesStates->containsStrict(false)) {
            $set('select_all', true);
        }

        if (true === $entitiesStates->containsStrict(false)) {
            $set('select_all', false);
        }
    }

    protected static function refreshEntitiesStatesViaSelectAll(\Closure $set, $state): void
    {
        collect(FilamentShield::getResources())->each(function ($entity) use ($set, $state) {
            $set($entity['resource'], $state);
            collect(Utils::getResourcePermissionPrefixes($entity['fqcn']))->each(function ($permission) use ($entity, $set, $state) {
                $set($permission.'_'.$entity['resource'], $state);
            });
        });

        collect(FilamentShield::getPages())->each(function ($page) use ($set, $state) {
            if (Utils::isPageEntityEnabled()) {
                $set($page, $state);
            }
        });

        collect(FilamentShield::getWidgets())->each(function ($widget) use ($set, $state) {
            if (Utils::isWidgetEntityEnabled()) {
                $set($widget, $state);
            }
        });

        static::getCustomEntities()->each(function ($custom) use ($set, $state) {
            if (Utils::isCustomPermissionEntityEnabled()) {
                $set($custom, $state);
            }
        });
    }

    protected static function refreshResourceEntityStateAfterUpdate(\Closure $set, \Closure $get, array $entity): void
    {
        $permissionStates = collect(Utils::getResourcePermissionPrefixes($entity['fqcn']))
            ->map(function ($permission) use ($get, $entity) {
                return (bool) $get($permission.'_'.$entity['resource']);
            });

        if (false === $permissionStates->containsStrict(false)) {
            $set($entity['resource'], true);
        }

        if (true === $permissionStates->containsStrict(false)) {
            $set($entity['resource'], false);
        }
    }

    protected static function refreshResourceEntityStateAfterHydrated(Model $record, \Closure $set, array $entity): void
    {
        $entities = $record->permissions->pluck('name')
            ->reduce(function ($roles, $role) {
                $roles[$role] = Str::afterLast($role, '_');

                return $roles;
            }, collect())
            ->values()
            ->groupBy(function ($item) {
                return $item;
            })->map->count()
            ->reduce(function ($counts, $role, $key) use ($entity) {
                $count = count(Utils::getResourcePermissionPrefixes($entity['fqcn']));
                if ($role > 1 && $role === $count) {
                    $counts[$key] = true;
                } else {
                    $counts[$key] = false;
                }

                return $counts;
            }, []);

        // set entity's state if one are all permissions are true
        if (Arr::exists($entities, $entity['resource']) && Arr::get($entities, $entity['resource'])) {
            $set($entity['resource'], true);
        } else {
            $set($entity['resource'], false);
            $set('select_all', false);
        }
    }
    /*--------------------------------*
    | Resource Related Logic End       |
    *----------------------------------*/

    /*--------------------------------*
    | Page Related Logic Start       |
    *----------------------------------*/

    protected static function getPageEntityPermissionsSchema(): array
    {
        return [];

        return collect(FilamentShield::getPages())->sortKeys()->reduce(function ($pages, $page) {
            $pages[] = Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Checkbox::make($page)
                        ->label(FilamentShield::getLocalizedPageLabel($page))
                        ->inline()
                        ->afterStateHydrated(function (\Closure $set, \Closure $get, $record) use ($page) {
                            if (is_null($record)) {
                                return;
                            }

                            $set($page, $record->checkPermissionTo($page));

                            static::refreshSelectAllStateViaEntities($set, $get);
                        })
                        ->reactive()
                        ->afterStateUpdated(function (\Closure $set, \Closure $get, $state) {
                            if (! $state) {
                                $set('select_all', false);
                            }

                            static::refreshSelectAllStateViaEntities($set, $get);
                        })
                        ->dehydrated(fn ($state): bool => $state),
                ])
                ->columns(1)
                ->columnSpan(1);

            return $pages;
        }, []);
    }
    /*--------------------------------*
    | Page Related Logic End          |
    *----------------------------------*/

    /*--------------------------------*
    | Widget Related Logic Start       |
    *----------------------------------*/

    protected static function getWidgetEntityPermissionSchema(): ?array
    {
        return [];

        return collect(FilamentShield::getWidgets())->reduce(function ($widgets, $widget) {
            $widgets[] = Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Checkbox::make($widget)
                        ->label(FilamentShield::getLocalizedWidgetLabel($widget))
                        ->inline()
                        ->afterStateHydrated(function (\Closure $set, \Closure $get, $record) use ($widget) {
                            if (is_null($record)) {
                                return;
                            }

                            $set($widget, $record->checkPermissionTo($widget));

                            static::refreshSelectAllStateViaEntities($set, $get);
                        })
                        ->reactive()
                        ->afterStateUpdated(function (\Closure $set, \Closure $get, $state) {
                            if (! $state) {
                                $set('select_all', false);
                            }

                            static::refreshSelectAllStateViaEntities($set, $get);
                        })
                        ->dehydrated(fn ($state): bool => $state),
                ])
                ->columns(1)
                ->columnSpan(1);

            return $widgets;
        }, []);
    }
    /*--------------------------------*
    | Widget Related Logic End          |
    *----------------------------------*/

    protected static function getCustomEntities(): ?Collection
    {
        return collect();
        $resourcePermissions = collect();
        collect(FilamentShield::getResources())->each(function ($entity) use ($resourcePermissions) {
            collect(Utils::getResourcePermissionPrefixes($entity['fqcn']))->map(function ($permission) use ($resourcePermissions, $entity) {
                $resourcePermissions->push((string) Str::of($permission.'_'.$entity['resource']));
            });
        });

        $entitiesPermissions = $resourcePermissions
            ->merge(FilamentShield::getPages())
            ->merge(FilamentShield::getWidgets())
            ->values();

        return static::$permissionsCollection->whereNotIn('name', $entitiesPermissions)->pluck('name');
    }

    protected static function getCustomEntitiesPermisssionSchema(): ?array
    {
        return collect(static::getCustomEntities())->reduce(function ($customEntities, $customPermission) {
            $customEntities[] = Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Checkbox::make($customPermission)
                        ->label(Str::of($customPermission)->headline())
                        ->inline()
                        ->afterStateHydrated(function (\Closure $set, \Closure $get, $record) use ($customPermission) {
                            if (is_null($record)) {
                                return;
                            }

                            $set($customPermission, $record->checkPermissionTo($customPermission));

                            static::refreshSelectAllStateViaEntities($set, $get);
                        })
                        ->reactive()
                        ->afterStateUpdated(function (\Closure $set, \Closure $get, $state) {
                            if (! $state) {
                                $set('select_all', false);
                            }

                            static::refreshSelectAllStateViaEntities($set, $get);
                        })
                        ->dehydrated(fn ($state): bool => $state),
                ])
                ->columns(1)
                ->columnSpan(1);

            return $customEntities;
        }, []);
    }
}

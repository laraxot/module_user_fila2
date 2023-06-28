<?php

namespace Modules\User\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Savannabits\FilamentModules\ContextServiceProvider;
use Filament\Navigation\UserMenuItem;

class FilamentServiceProvider extends ContextServiceProvider
{
    public static string $name = 'user-filament';
    public static string $module = 'User';

    public function packageRegistered(): void
    {
        $this->app->booting(function () {
            $this->registerConfigs();
        });
        parent::packageRegistered();
    }

    public function registerConfigs() {
        $this->mergeConfigFrom(
            app('modules')->findOrFail(static::$module)->getExtraPath( 'Config/'.static::$name.'.php'),
            static::$name
        );
    }

    public function boot()
    {
        parent::boot();
        Filament::serving(function () {
            Filament::forContext('filament', function (){
                Filament::registerNavigationItems([
                    NavigationItem::make(static::$module)
                        ->label(static::$module.'s ')
                        ->url(route(static::$name.'.pages.dashboard'))
                        ->icon('heroicon-o-users')
                        ->group('Modules')
                ]);
            });
            Filament::forContext(static::$name, function (){
                Filament::registerRenderHook('sidebar.start',fn():string => \Blade::render('<div class="p-2 px-6 bg-primary-100 font-black w-full">'.static::$module.' Module</div>'));
            });
            $userMenuItems = [];
            /*
            $userMenuItems['team-settings'] = UserMenuItem::make()
                            ->label(__('filament-jet::jet.user_menu.team_settings'))
                            ->icon(config('filament-jet.user_menu.team_settings.icon', 'heroicon-o-cog'))
                            ->sort(config('filament-jet.user_menu.team_settings.sort'))
                            ->url(\Modules\User\Filament\Pages\TeamSettings::getUrl());
            */
            /*
            $userMenuItems['create-team'] = UserMenuItem::make()
                            ->label(__('filament-jet::jet.user_menu.create_team'))
                            ->icon(config('filament-jet.user_menu.create_team.icon', 'heroicon-o-users'))
                            ->sort(config('filament-jet.user_menu.create_team.sort'))
                            ->url(\Modules\User\Filament\Pages\CreateTeam::getUrl());
            
            Filament::registerUserMenuItems($userMenuItems);
            */
        });
    }
}

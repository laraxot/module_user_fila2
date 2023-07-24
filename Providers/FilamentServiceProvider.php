<?php

namespace Modules\User\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Savannabits\FilamentModules\ContextServiceProvider;
use Savannabits\FilamentModules\FilamentModules;

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

    public function registerConfigs()
    {
        $this->mergeConfigFrom(
            app('modules')->findOrFail(static::$module)->getExtraPath('Config/'.static::$name.'.php'),
            static::$name
        );
    }

    public function boot()
    {
        parent::boot();
        app(FilamentModules::class)->prepareDefaultNavigation(static::$module, static::$name);
    }
}

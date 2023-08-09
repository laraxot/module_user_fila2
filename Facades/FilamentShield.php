<?php

namespace Modules\User\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BezhanSalleh\FilamentShield\FilamentShield
 *
 * @method getWidgets()
 */
class FilamentShield extends Facade
{
    /**
     * @psalm-return 'filament-shield'
     */
    protected static function getFacadeAccessor(): string
    {
        return 'filament-shield';
    }
}

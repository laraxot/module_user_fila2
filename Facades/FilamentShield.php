<<<<<<< HEAD
<?php

declare(strict_types=1);

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
=======
<?php

namespace Modules\User\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BezhanSalleh\FilamentShield\FilamentShield
 * @method getWidgets()
 */
class FilamentShield extends Facade
{
    /**
     * @return string
     *
     * @psalm-return 'filament-shield'
     */
    protected static function getFacadeAccessor(): string
    {
        return 'filament-shield';
    }
}
>>>>>>> d1783f5 (up)

<<<<<<< HEAD
<<<<<<< HEAD
<?php

declare(strict_types=1);

namespace Modules\User\Datas;

use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;

/**
 * Undocumented class.
 */
class FilamentShieldData extends Data
{
    public ShieldResourceData $shield_resource;

    public SuperAdminData $super_admin;
    public FilamentUserData $filament_user;

    public static function make(): self
    {
        Assert::isArray($xot = config('filament-shield'), 'check config [filament-shield] ');

        return self::from($xot);
    }
}
=======
=======
>>>>>>> c3ef5a0 (up)
<?php

declare(strict_types=1);

namespace Modules\User\Datas;

use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;

/**
 * Undocumented class.
 */
class FilamentShieldData extends Data {
    public ShieldResourceData $shield_resource;

    public SuperAdminData $super_admin;
    public FilamentUserData $filament_user;

    public static function make(): self {
        Assert::isArray($xot = config('filament-shield'), 'check config [filament-shield] ');

        return self::from($xot);
    }
}
<<<<<<< HEAD
>>>>>>> d1783f5 (up)
=======
>>>>>>> c3ef5a0 (up)

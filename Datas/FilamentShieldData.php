<?php

declare(strict_types=1);

namespace Modules\User\Datas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        $xot = config('filament-shield');

        if (! is_array($xot)) {
            dddx($xot);
        }

        return self::from($xot);
    }

}

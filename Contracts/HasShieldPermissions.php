<?php

declare(strict_types=1);

namespace Modules\User\Contracts;

interface HasShieldPermissions
{
    public static function getPermissionPrefixes(): array;
}

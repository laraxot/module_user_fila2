<?php

declare(strict_types=1);

namespace Modules\User\Models;

/**
 * Modules\User\Models\RoleHasPermission
 *
 * @property int $permission_id
 * @property int $role_id
 * @method static \Modules\LU\Database\Factories\RoleHasPermissionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RoleHasPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleHasPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleHasPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleHasPermission wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleHasPermission whereRoleId($value)
 * @mixin \Eloquent
 */
class RoleHasPermission extends BasePivot
{
    protected $fillable = ['permission_id', 'role_id'];
}
<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class PermissionService
{
    public static $permissionsByRole = [
        'admin' => [
            'User' => ['view users', 'create user', 'edit user', 'archive user', 'restore user'],
            'Role' => ['view roles', 'create role', 'edit role', 'archive role', 'restore role'],
        ],
        'user' => [],
    ];

    public static function allPermissionsGrouped(): array
    {
        return self::$permissionsByRole['admin'];
    }
}

<?php

namespace App\Permissions;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;

class Permissions
{
    /**
     * Register active permissions as gates.
     *
     * @return mixed
     */
    public static function gates()
    {
        try {
            return Permission::active()->get()->map(function ($permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        } catch (\Exception $e) {
            // log exception
        }
    }
}
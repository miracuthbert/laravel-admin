<?php

namespace App\Providers;

use App\Http\ViewComposers\ParentRolesComposer;
use App\Http\ViewComposers\PermissionsComposer;
use App\Http\ViewComposers\RolesComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // permissions
        View::composer('admin.permissions.partials.forms._permissions', PermissionsComposer::class);

        // roles
        View::composer('admin.roles.partials.forms._roles', RolesComposer::class);

        // parent roles
        View::composer('admin.roles.partials.forms._parent_roles', ParentRolesComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

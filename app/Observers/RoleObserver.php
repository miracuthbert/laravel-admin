<?php

namespace App\Observers;

use App\Models\Role;

class RoleObserver
{
    /**
     * Handle the role "creating" event.
     *
     * @param  \App\Models\Role $role
     * @return void
     */
    public function creating(Role $role)
    {
        $prefix = $role->ancestors->count() ?
            implode(' > ', $role->ancestors->pluck('name')->toArray()) . ' ' : null;

        $role->slug = str_slug($prefix . $role->name);

        // make children role usable
        $role->usable = $role->parent ? true : false;
    }

    /**
     * Handle the role "created" event.
     *
     * @param  \App\Models\Role $role
     * @return void
     */
    public function created(Role $role)
    {
        //
    }

    /**
     * Handle the role "updated" event.
     *
     * @param  \App\Models\Role $role
     * @return void
     */
    public function updated(Role $role)
    {
        //
    }

    /**
     * Handle the role "deleted" event.
     *
     * @param  \App\Models\Role $role
     * @return void
     */
    public function deleted(Role $role)
    {
        //
    }

    /**
     * Handle the role "restored" event.
     *
     * @param  \App\Models\Role $role
     * @return void
     */
    public function restored(Role $role)
    {
        //
    }

    /**
     * Handle the role "force deleted" event.
     *
     * @param  \App\Models\Role $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        //
    }
}

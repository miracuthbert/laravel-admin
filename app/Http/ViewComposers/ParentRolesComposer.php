<?php

namespace App\Http\ViewComposers;

use App\Models\Role;
use Illuminate\View\View;

class ParentRolesComposer
{
    /**
     * A Collection of Roles.
     *
     * @var $roles
     */
    private $roles;

    /**
     * Roles to be shared with in view.
     *
     * @param View $view
     * @return View
     */
    public function compose(View $view)
    {
        if (!$this->roles) {
            $this->roles = Role::whereDoesntHave('parent')->whereDoesntHave('users')->get();
        }

        return $view->with('roles', $this->roles);
    }
}
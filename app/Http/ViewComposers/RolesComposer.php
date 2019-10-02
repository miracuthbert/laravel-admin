<?php

namespace App\Http\ViewComposers;

use App\Models\Role;
use Illuminate\View\View;

class RolesComposer
{
    /**
     * Roles.
     *
     * @var $roles
     */
    private $roles;

    public function compose(View $view)
    {
        if (!$this->roles) {
            $this->roles = Role::get()->toTree();
        }

        return $view->with('roles', $this->roles);
    }
}
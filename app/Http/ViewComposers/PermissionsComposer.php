<?php

namespace App\Http\ViewComposers;

use App\Models\Permission;
use Illuminate\View\View;

class PermissionsComposer
{
    /**
     * Active permissions.
     *
     * @var $permissions
     */
    private $permissions;

    /**
     * @param View $view
     * @return View
     */
    public function compose(View $view)
    {
        if (!$this->permissions) {
            $this->permissions = Permission::active()->get();
        }

        return $view->with('permissions', $this->permissions);
    }
}
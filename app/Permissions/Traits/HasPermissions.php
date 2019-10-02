<?php

namespace App\Permissions\Traits;

use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;

trait HasPermissions
{
    /**
     * Assign user a role by slug.
     *
     * @param $roleSlug
     * @param null $expiresAt
     * @return bool
     */
    public function assignRoleBySlug($roleSlug, $expiresAt = null)
    {
        $role = Role::where('slug', $roleSlug)->first();

        return $this->assignRole($role, $expiresAt);
    }

    /**
     * Assign user a role by id.
     *
     * @param $roleId
     * @param null $expiresAt
     * @return bool
     */
    public function assignRoleById($roleId, $expiresAt = null)
    {
        $role = Role::find($roleId);

        return $this->assignRole($role, $expiresAt);
    }

    /**
     * Assign user a role.
     *
     * @param Role $role
     * @param null $expiresAt
     * @return bool
     */
    public function assignRole(Role $role, $expiresAt = null)
    {
        if (!($this->hasRole($role->slug))) {

            if (isset($expiresAt)) {
                $expiresAt = Carbon::parse($expiresAt)->toDateTimeString();
            }

            $this->roles()->attach($role->id, ['expires_at' => $expiresAt]);

            return true;
        }

        return false;
    }

    /**
     * Update user's role by id.
     *
     * @param $roleId
     * @param null $expiresAt
     */
    public function updateRoleById($roleId, $expiresAt = null)
    {
        $role = Role::where('id', $roleId)->first();

        $this->updateRole($role, $expiresAt);
    }

    /**
     * Update user's role.
     *
     * @param Role $role
     * @param null $expiresAt
     * @return bool
     */
    public function updateRole(Role $role, $expiresAt = null)
    {
        if ($this->hasRole($role->slug)) {
            if (isset($expiresAt)) {
                $expiresAt = Carbon::parse($expiresAt)->toDateTimeString();
            }

            $this->roles()->updateExistingPivot($role->id, ['expires_at' => $expiresAt]);

            return true;
        }

        return false;
    }

    /**
     * Check if user has given roles.
     *
     * @param $roles
     * @return bool
     */
    public function hasRole(...$roles)
    {
        $roles = Role::with('children')->whereIn('slug', $roles)->get();

        foreach ($roles as $role) {
            $slugs = $role->children->pluck('slug')->push($role->slug)->toArray();

            $exists = (bool)$this->roles()->whereNull('expires_at')
                ->orWhere('expires_at', '>', Carbon::now())
                ->whereIn('slug', $slugs)
                ->count();

            if ($exists) {
                return true;
            }
        }

        return false;
    }

    /**
     * Assigns permission(s) to user.
     *
     * @param array ...$permissions
     * @return $this
     */
    public function givePermissionTo(...$permissions)
    {
        $permissions = $this->getAllPermissions(array_flatten($permissions));

        if ($permissions === null) {
            return $this;
        }

        $this->permissions()->saveMany($permissions);

        return $this;
    }

    /**
     * Remove permission(s) from user.
     *
     * @param array ...$permissions
     * @return $this
     */
    public function withdrawPermissionTo(...$permissions)
    {
        $permissions = $this->getAllPermissions(array_flatten($permissions));

        $this->permissions()->detach($permissions);

        return $this;
    }

    /**
     * Update user's permissions.
     *
     * @param array ...$permissions
     * @return $this
     */
    public function updatePermissions(...$permissions)
    {
        $this->permissions()->detach();

        return $this->givePermissionTo($permissions);
    }

    /**
     * Get permissions.
     *
     * @param array $permissions
     * @return mixed
     */
    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('name', $permissions)->get();
    }

    /**
     * Check if given model has given permission.
     *
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    /**
     * Check if user has given permission through role.
     *
     * @param $permission
     * @return bool
     */
    protected function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if (
            $this->roles()->whereNull('expires_at')
                ->orWhere('expires_at', '>', Carbon::now())
                ->where('slug', $role->slug)
                ->count()
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if given permission exists and has not expired.
     *
     * @param $permission
     * @return bool
     */
    protected function hasPermission($permission)
    {
        return (bool)$this->permissions
            ->where('name', $permission->name)
            ->where('permitable.expires_at', null)->count();
    }

    /**
     * Get the roles that belong to the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles')
            ->as('roleable')
            ->withTimestamps()
            ->withPivot(['expires_at']);
    }

    /**
     * Get the permission that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions')
            ->as('permitable')
            ->withTimestamps()
            ->withPivot(['expires_at']);
    }
}
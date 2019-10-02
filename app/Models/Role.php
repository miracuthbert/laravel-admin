<?php

namespace App\Models;

use App\Models\Traits\IsUsableTrait;
use App\Models\Traits\PivotOrderableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Role extends Model
{
    use SoftDeletes, NodeTrait, IsUsableTrait, PivotOrderableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'details',
        'usable',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Set role order.
     *
     * @param $order
     * @param $roleId
     * @return bool
     */
    public function setRoleOrder($order, $roleId)
    {
        $node = Role::find($roleId);

        switch ($order):
            case 'after':
                $this->insertAfterNode($node);
                return true;
            case 'before':
                $this->insertBeforeNode($node);
                return true;
            case 'child':
                $this->parent()->associate($node);

                // prevent listings to be created under category
                $node->update(['usable' => false]);
                return true;
            default:
                return false;
        endswitch;
    }

    /**
     * Handle adding and deleting of role permissions.
     *
     * @param $permissions
     */
    public function syncPermissions($permissions)
    {
        $this->deleteRemovedPermissions($permissions);

        $this->addPermissions($permissions);
    }

    /**
     * Add permissions to role.
     *
     * @param $ids
     */
    public function addPermissions($ids)
    {
        $this->permissions()->syncWithoutDetaching($ids);
    }

    /**
     * Delete removed permissions from role based on passed ones.
     *
     * @param $ids
     */
    public function deleteRemovedPermissions($ids)
    {
        if ($this->permissions->isEmpty()) {
            return;
        }

        $oldPermissions = $this->permissions()->whereNotIn('id', $ids)
            ->pluck('id')
            ->toArray();

        $this->permissions()->detach($oldPermissions);
    }

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles')
            ->withTimestamps()
            ->withPivot(['expires_at']);
    }

    /**
     * The permissions that belong to the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions')
            ->withTimestamps();
    }
}

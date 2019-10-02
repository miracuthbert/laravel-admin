<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Requests\Admin\UserRoleStoreRequest;
use App\Http\Requests\Admin\UserRoleUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRoleStoreRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(UserRoleStoreRequest $request, User $user)
    {
        if (Gate::denies('assign roles')) {
            return abort(404);
        }

        // find role
        $role = Role::find($request->role_id);

        if ($user->hasRole($role->slug)) {
            return back()->withInput()->withError('User has this role.');
        }

        // assign role
        $assigned = $user->assignRole($role, $request->expires_at);

        // redirect back if failed
        if (!$assigned) {
            return back()->withInput()->withError("Failed while assigning user, `{$role->name}` role.");
        }

        return back()->withSuccess("User assigned `{$role->name}` role successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Role $role)
    {
        if (Gate::denies('assign roles')) {
            return abort(404);
        }

        $role = $user->roles->where('id', $role->id)->first();

        return view('admin.users.roles.edit', compact('user', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRoleUpdateRequest $request
     * @param  \App\Models\User $user
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(UserRoleUpdateRequest $request, User $user, Role $role)
    {
        if (Gate::denies('assign roles')) {
            return abort(404);
        }

        // update role
        $updated = $user->updateRole($role, $request->expires_at);

        // redirect back with error if failed
        if (!$updated) {
            return back()->withInput()->withError("Failed while updating user's role.");
        }

        return back()->withSuccess('User role updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Role $role)
    {
        if (Gate::denies('assign roles')) {
            return abort(404);
        }

        // revoke role from user
        $revoked = $user->updateRole($role, now());

        // redirect back with error if failed
        if (!$revoked) {
            return back()->withInput()->withError("Failed while trying to revoke `{$role->name}`, role from user.");
        }

        return back()->withSuccess("`{$role->name}`, role  revoked from user.");
    }
}

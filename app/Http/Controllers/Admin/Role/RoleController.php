<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::withCount('users')->withDepth()->get()->toFlatTree();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $role = new Role();
        $role->fill($request->only('name'));
        $role->usable = $request->usable ?? false;

        $role->parent()->associate(Role::find($request->parent_id));

        $role->save();

        $role->addPermissions($request->permissions);

        return redirect()->route('admin.roles.index')
            ->withSuccess("`{$role->name}`, role created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleUpdateRequest $request
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $role->fill($request->only('name'));
        $role->usable = $request->usable ?? false;

        $role->parent()->associate(Role::find($request->parent_id));

        $role->save();

        $role->syncPermissions($request->permissions);

        return back()->withSuccess("Role updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        // prevent role deletion if it has users
        if ($role->children->count()) {
            return back()->withError("You cannot delete `{$role->name}` role group, since it has children.")
                ->withInfo("Delete the children roles first before deleting the a group.");
        }

        // prevent role deletion if it has users
        if ($role->users->count()) {
            return back()->withError("You cannot delete `{$role->name}`, role since it is assigned.")
                ->withInfo("Only roles without user history can be deleted.");
        }

        try {
            $role->delete();
        } catch (\Exception $e) {
            return back()->withError("Some error occured while deleting `{$role->name}`, role. Try again!");
        }

        return back()->withSuccess("`{$role->name}`, role deleted.");
    }
}

<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();

        if(!$role)
        {
            toast()
                ->warning('No role found!')
                ->pushOnNextPage();

            return redirect(route('admin.role'));
        }

        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function givePermission(Request $request, string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            toast()
                ->warning('No role found!')
                ->pushOnNextPage();

            return redirect(route('admin.role'));
        }

        $selectedPermissions = $request->input('permissions', []);

        $permissionsToSync = [];

        // Check if each selected permission already exists in the role
        foreach ($selectedPermissions as $selectedPermission) {
            // Check if the permission already exists in the role
            if (!$role->hasPermissionTo($selectedPermission)) {
                // Permission doesn't exist in the role, add it to the permissions to sync
                $permissionsToSync[] = $selectedPermission;
            }
        }

        // Sync the selected permissions with the role
        $role->syncPermissions($permissionsToSync);

        toast()
            ->success('Permissions synced successfully')
            ->pushOnNextPage();

        return redirect(route('admin.role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            toast()
                ->warning('No role found!')
                ->pushOnNextPage();

            return redirect(route('admin.role'));
        }

        $validated = $request->validate([
            'name' => 'required|string|min:3'
        ]);

        $role->name = $validated['name'];

        $role->update();

        toast()
            ->success('Role updated successfully')
            ->pushOnNextPage();

        return redirect(route('admin.role'));
    }

    public function revokePermission(string $roleId, string $permissionId)
    {
        $role = Role::find($roleId);

        if (!$role) {
            toast()
                ->warning('No role found!')
                ->pushOnNextPage();

            return redirect(route('admin.role'));
        }

        $permission = Permission::find($permissionId);

        if (!$permission) {
            toast()
                ->warning('No permission found!')
                ->pushOnNextPage();

            return redirect(route('admin.role'));
        }

        $role->revokePermissionTo($permission);

        toast()
            ->success('Permission revoked successfully')
            ->pushOnNextPage();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            toast()
                ->warning('No role found!')
                ->pushOnNextPage();

            return redirect(route('admin.role'));
        }

        $role->delete();

        toast()
            ->success('Role deleted successfully')
            ->pushOnNextPage();

        return redirect(route('admin.role'));
    }
}

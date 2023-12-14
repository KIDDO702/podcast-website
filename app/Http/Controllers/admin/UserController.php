<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\UploadTemp;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|string|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:8|confirmed|'
        ]);

        $user = new User([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => $validated['password']
        ]);

        $tmp = UploadTemp::where('folder', $request->avatar)->first();

        if ($tmp)
        {
            $user->addMedia(storage_path('app/tmp/'.$request->avatar. '/' . $tmp->filename))
                 ->toMediaCollection('avatar');

            Storage::delete('app/tmp/'.$request->avatar);
            $tmp->delete();
        }

        $user->save();

        toast()
            ->success('User added successfully')
            ->pushOnNextPage();

        return back();
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
        $user = User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();

        if(!$user)
        {
            toast()
                ->warning('user not found')
                ->pushOnNextPage();

            return back();
        }

        $rolePermissions = $user->getPermissionsViaRoles();
        $userDirectPermissions = $user->permissions;
        $allPermissions = $rolePermissions->merge($userDirectPermissions)->unique();

        return view('admin.user.edit', compact('user', 'roles', 'permissions', 'allPermissions'));
    }

    public function assignRole(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if (!$user) {

            toast()
                ->warning('invalid user')
                ->pushOnNextPage();

            return back();
        }

        $request->validate([
            'roles' => 'required|array',
        ]);

        $currentRoles = $user->getRoleNames()->toArray();
        $newRoles = array_diff($request->input('roles'), $currentRoles);

        $user->assignRole($newRoles);

        toast()
            ->success('Roles added successfullty to '.$user->name)
            ->pushOnNextPage();

        return back();
    }

    public function revokeRole(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if (!$user) {

            toast()
                ->warning('invalid user')
                ->pushOnNextPage();

            return back();
        }

        $role = Role::find($request->input('role'));

        // Revoke specified roles from the user
        $user->roles()->detach($role);

        toast()
            ->success('Roles successfullty removed to ' . $user->name)
            ->pushOnNextPage();

        return back();
    }

    public function assignPermission(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if (!$user) {

            toast()
                ->warning('invalid user')
                ->pushOnNextPage();

            return back();
        }

        $request->validate([
            'permissions' => 'required|array'
        ]);

        $currentPermissions = $user->permissions->pluck('name')->toArray();
        $newPermissions = array_diff($request->input('permissions'), $currentPermissions);

        $user->givePermissionTo($newPermissions);

        toast()
            ->success('Permissions has been granted to '.$user->name)
            ->pushOnNextPage();

        return back();
    }

    public function revokePermission(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if (!$user) {

            toast()
                ->warning('invalid user')
                ->pushOnNextPage();

            return back();
        }

        $permission = Permission::find($request->input('permission'));

        $user->revokePermissionTo($permission);

        toast()
            ->success('Permission has been revoked')
            ->pushOnNextPage();

        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::where('id', $id)->first();

        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id),],
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($user->id),],
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|min:8|string|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->username = $validated['username'];

        // Check if a new password is provided
        if ($validated['new_password'] !== null) {
            // Check if the current password is correct
            if (!Hash::check($validated['current_password'], $user->password)) {
                toast()
                    ->warning('Incorrect password, please try again')
                    ->pushOnNextPage();

                return back();
            }

            // Update the password
            $user->password = Hash::make($validated['new_password']);
        }

        $tmp = UploadTemp::where('folder', $request->avatar)->first();

        if ($tmp) {

            $user->clearMediaCollection('avatar');
            $user->addMedia(storage_path('app/tmp/' . $request->avatar . '/' . $tmp->filename))
                ->toMediaCollection('avatar');

            Storage::delete('app/tmp/' . $request->avatar);
            $tmp->delete();
        }

        $user->update();


        toast()
            ->success('Profile updated successfully')
            ->pushOnNextPage();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

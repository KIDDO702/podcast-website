<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

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

        if(!$role)
        {
            toast()
                ->warning('No role found!')
                ->pushOnNextPage();

            return redirect(route('admin.role'));
        }

        return view('admin.role.edit', compact('role'));
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

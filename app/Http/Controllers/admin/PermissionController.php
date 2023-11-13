<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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
        $permission = Permission::find($id);

        if (!$permission) {
            toast()
                ->warning('No permission found')
                ->pushOnNextPage();

            return redirect(route('admin.permission'));
        }

        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            toast()
                ->warning('No permission found')
                ->pushOnNextPage();

            return redirect(route('admin.permission'));
        }

        $validated = $request->validate([
            'name' => 'required|string|min:3'
        ]);

        $permission->name = $validated['name'];
        $permission->update();

        toast()
            ->success('Permission updated successfully')
            ->pushOnNextPage();

        return redirect(route('admin.permission'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            toast()
                ->warning('No permission found')
                ->pushOnNextPage();

            return redirect(route('admin.permission'));
        }

        $permission->delete();

        toast()
            ->success('Permission deleted successfully')
            ->pushOnNextPage();

        return redirect(route('admin.permission'));
    }
}

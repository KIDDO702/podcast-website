<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\UploadTemp;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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

        if(!$user)
        {
            toast()
                ->warning('user not found')
                ->pushOnNextPage();

            return back();
        }

        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

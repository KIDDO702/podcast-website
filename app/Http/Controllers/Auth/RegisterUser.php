<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUser extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string|min:8',
            'email' => 'required|string|email|unique:users,email',
            'username' => 'required|min:3|unique:users,username',
            'password' => 'required|string|confirmed|min:8'
        ]);

        try {
            $user = User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'username' => $credentials['username'],
                'password' => Hash::make($credentials['password'])
            ]);

            $request->session()->regenerate();
            Auth::login($user);

        } catch (\Throwable $th) {

            return response($th, 500);
        }

        toast()
            ->success('welcome to blvck')
            ->pushOnNextPage();

        return redirect(route('home'));
    }

    public function updateUser(Request $request)
    {
        dd($request->all());
    }
}

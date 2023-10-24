<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSession extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|min:8'
        ]);

        try {

            if (Auth::attempt($credentials, $request->get('remember'))) {

                $request->session()->regenerate();

            } else {

                toast()
                    ->warning('wrong credentials! please try again')
                    ->push();

                return back();
            }

        } catch (\Throwable $th) {

            return $th;
        }


        toast()
            ->success('Signed In Sussessfully')
            ->pushOnNextPage();

        return redirect(route('home'));
    }


    public function passwordView(): View
    {
        return view('auth.confirm-password');
    }

    public function confirmPassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'password' => 'required'
        ]);

        if (! Hash::check($validated['password'], $request->user()->password)) {

            toast()
                ->warning('The provided password does not match our records')
                ->pushOnNextPage();

            return back();
        }

        $request->session()->passwordConfirmed();

        return redirect()->intended();
    }



    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();


        toast()
            ->success('Logged out successfully, see you soon')
            ->pushOnNextPage();

        return redirect(route('home'));
    }
}

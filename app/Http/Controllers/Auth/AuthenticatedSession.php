<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

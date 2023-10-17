@extends('layout.auth')


@section('form')
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf
        <div class="w-full">
            <input type="email" name="email" id="email" placeholder="Email or Username" class="bg-gray-50 w-full px-4 py-2.5 rounded border border-gray-300 focus:outline focus:outline-slate-400 focus:outline-offset-2">
            @error('email')
                <small class="text-red-800 font-semibold">{{ $message }}</small>
            @enderror
        </div>
        <div class="w-full mt-6">
            <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-50 w-full px-4 py-2.5 rounded border border-gray-300 focus:outline focus:outline-slate-400 focus:outline-offset-2">
            @error('password')
                <small class="text-red-800 font-semibold">{{ $message }}</small>
            @enderror
        </div>
        <div class="flex items-center justify-between mt-6">
            <div class="flex items-center space-x-3">
                <input id="remember" type="checkbox" name="remember" value="1" class="w-5 h-5 text-slate-700 bg-gray-100 border-gray-200 rounded focus:ring-slate-700 focus:ring">
                <label for="remember" class="text-gray-900 font-semibold">Remember Me</label>
            </div>
        </div>
        <div class="mt-7">
            <button type="submit" class="w-full px-4 py-2.5 bg-red-800 text-white font-semibold rounded focus:ring focus:ring-red-800 focus:ring-offset-2">
                Sign In
            </button>
        </div>
        <div class="mt-7">
            <p>
                Not a member
                <a href="{{ route('register') }}" class="text-red-800 underline underline-offset-2">Sign Up</a>
            </p>
        </div>

    </form>
@endsection

@extends('layout.auth')

@section('form')
    <form action="{{ route('auth.register') }}" method="POST">
        @csrf
        <div class="w-full">
            <input type="text" name="name" id="name" placeholder="Name" class="w-full px-4 py-2.5 rounded border border-gray-200 focus:outline focus:outline-slate-400 focus:outline-offset-2">
            @error('name')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>
        <div class="w-full mt-6">
            <input type="email" name="email" id="email" placeholder="Email" class="w-full px-4 py-2.5 rounded border border-gray-200 focus:outline focus:outline-slate-400 focus:outline-offset-2">
            @error('email')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>
        <div class="w-full mt-6">
            <input type="text" name="username" id="username" placeholder="Username" class="w-full px-4 py-2.5 rounded border border-gray-200 focus:outline focus:outline-slate-400 focus:outline-offset-2">
            @error('username')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>
        <div class="w-full mt-6">
            <input type="password" name="password" id="password" placeholder="Password" class="w-full px-4 py-2.5 rounded border border-gray-200 focus:outline focus:outline-slate-400 focus:outline-offset-2">
            @error('password')
                <small class="text-red-700">{{ $message }}</small>
            @enderror
        </div>
        <div class="w-full mt-6">
            <input type="password" name="password_confirmation" id="password" placeholder="Confirm Password" class="w-full px-4 py-2.5 rounded border border-gray-200 focus:outline focus:outline-slate-400 focus:outline-offset-2">
        </div>
        {{-- <div class="flex items-center justify-between mt-6">
            <div class="flex items-center space-x-3">
                <input checked id="teal-checkbox" type="checkbox" value="" class="w-5 h-5 text-slate-700 bg-gray-100 border-gray-300 rounded focus:ring-slate-700 focus:ring">
                <label for="teal-checkbox" class="text-gray-900 font-semibold">Remember Me</label>
            </div>
        </div> --}}
        <div class="mt-7">
            <button type="submit" class="w-full px-4 py-2.5 bg-red-800 text-white font-semibold rounded focus:ring focus:ring-red-800 focus:ring-offset-2">
                Sign Up
            </button>
        </div>
        <div class="mt-7">
            <p>
                Already a member
                <a href="{{ route('login') }}" class="text-red-800 underline underline-offset-2">Sign In</a>
            </p>
        </div>
    </form>
@endsection

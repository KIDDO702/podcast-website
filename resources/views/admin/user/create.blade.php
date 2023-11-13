@extends('layout.admin')

@section('body')
    <div class="bg-white rounded drop-shadow flex justify-between items-center py-2 px-4">
        <h3 class="font-bold text-slate-900 text-2xl">Users</h3>


        <ul class="flex items-center space-x-3">
            <li>
                <a href="{{ route('admin.index') }}" class="text-red-800 underline underline-offset-1">
                    <small class="font-semibold">Dashboard</small>
                </a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 flex items-center justify-center">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>

            </li>
            <li>
                <a href="{{ route('admin.user') }}" class="text-red-800 underline underline-offset-1">
                    <small class="font-semibold">Users</small>
                </a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 flex items-center justify-center">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </li>
             <li>
                <small class="text-gray-600 font-semibold">Create</small>
            </li>
        </ul>
    </div>

    <div class="mt-10">
        <form action="{{ route('admin.user.store') }}" method="POST" class="w-full">
            @csrf
            <div class="w-[50%] mx-auto my-10">
                <label for="avatar" class="font-semibold text-gray-600">Avatar</label>
                <input type="file" id="avatar" name="avatar" class="mt-0.5 drop-shadow">
            </div>

            <div class="w-full mt-3 bg-white drop-shadow rounded p-7">
                <div class="w-full flex space-x-7">
                    <div class="w-[50%]">
                        <label for="name" class="font-semibold text-gray-700">Name</label>
                        <input type="text" name="name" placeholder="Name e.g. Robert Ochieng" class="w-full mt-0.5 bg-gray-50 border border-gray-200 px-4  py-2 rounded focus:outline focus:outline-gray-400 focus:outline-offset-2 placeholder:text-sm">
                        @error('name')
                            <small class="text-red-800">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-[50%]">
                        <label for="email" class="font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" placeholder="robarangs@gmail.com" class="w-full mt-0.5 bg-gray-50 border border-gray-200 px-4 py-2 rounded focus:outline focus:outline-gray-400 focus:outline-offset-2 placeholder:text-sm">
                        @error('email')
                            <small class="text-red-800">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="w-full mt-7 flex space-x-7">
                    <div class="w-[50%]">
                        <label for="username" class="font-semibold text-gray-700">Username</label>
                        <input type="text" name="username" placeholder="kiddo" class="w-full mt-0.5 bg-gray-50 border border-gray-200 px-4  py-2 rounded focus:outline focus:outline-gray-400 focus:outline-offset-2 placeholder:text-sm">
                        @error('username')
                            <small class="text-red-800">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-[50%]">
                        <label for="password" class="font-semibold text-gray-700">Password</label>
                        <input type="password" name="password" placeholder="pass123" class="w-full mt-0.5 bg-gray-50 border border-gray-200 px-4 py-2 rounded focus:outline focus:outline-gray-400 focus:outline-offset-2 placeholder:text-sm">
                        @error('password')
                            <small class="text-red-800">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="w-full mt-7">
                    <label for="password" class="font-semibold text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="confirmation" placeholder="pass123" class="w-full mt-0.5 bg-gray-50 border border-gray-200 px-4 py-2 rounded focus:outline focus:outline-gray-400 focus:outline-offset-2 placeholder:text-sm">
                </div>
            </div>

            <div class="mt-10">
                <button type="submit" class="bg-red-800 text-white font-semibold px-4 py-2 rounded hover:bg-red-700 focus:ring focus:ring-red-800 focus:ring-offset-2">
                    Create User
                </button>
            </div>
        </form>
    </div>
@endsection

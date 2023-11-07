@extends('layout.admin')

@section('body')
    <div class="bg-white rounded drop-shadow-sm flex justify-between items-center py-2 px-4">
        <h3 class="font-bold text-slate-900 text-2xl">Role</h3>


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
                <a href="{{ route('admin.role') }}" class="text-red-800 underline underline-offset-1">
                    <small class="font-semibold">Roles</small>
                </a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 flex items-center justify-center">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </li>
            <li>
                <small class="text-gray-600 font-semibold">Edit</small>
            </li>
        </ul>
    </div>

    <div class="mt-10 bg-white p-7 drop-shadow-sm rounded">
        <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div>
                <input type="text" value="{{ $role->name }}" name="name" class="w-full bg-gray-50 border border-slate-200 rounded-sm px-4 py-2 focus:outline focus:outline-slate-400 focus:outline-offset-2">
                @error('name')
                    <small class="text-red-800 font-semibold">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-7">
                <button type="submit" class="bg-slate-900 text-white px-4 py-2 font-semibold rounded focus:ring focus:ring-slate-900 focus:ring-offset-2">
                    Edit
                </button>
            </div>
        </form>
    </div>

    <div class="mt-10">
        <div class="bg-white drop-shadow-sm px-7 py-6 rounded">
            <livewire:admin.role-table />
        </div>
    </div>
@endsection

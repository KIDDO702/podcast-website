@extends('layout.admin')

@section('body')
    <div class="bg-white rounded drop-shadow-sm flex justify-between items-center py-2 px-4">
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
                <small class="text-gray-600 font-semibold">Edit</small>
            </li>
        </ul>
    </div>

    <div class="my-10">
        <div class="flex items-start justify-between">
            <div class="w-[60%]">
                <div class="w-[50%] mx-auto">
                    <img src="{{ $user->getFirstMediaUrl('avatar') }}" alt="{{ $user->username }}" class="w-[50%] rounded">
                </div>

                <div class="bg-white rounded drop-shadow mt-10 p-5">
                    <div class="w-full flex items-center space-x-5">
                        <div class="w-[50%]">
                            <input type="text" value="{{ $user->name }}" class="cursor-not-allowed bg-gray-50 border border-slate-300 py-2 px-2 rounded text-gray-700 text-sm w-full" disabled>
                        </div>
                        <div class="w-[50%]">
                            <input type="text" value="{{ $user->username }}" class="cursor-not-allowed bg-gray-50 border border-slate-300 py-2 px-2 rounded text-gray-700 text-sm w-full" disabled>
                        </div>
                    </div>
                    <div class="w-full mt-5">
                        <input type="text" value="{{ $user->email }}" class="cursor-not-allowed bg-gray-50 border border-slate-300 py-2 px-2 rounded text-gray-700 text-sm w-full" disabled>
                    </div>
                    <div class="mt-5">
                        @if ($user->roles->count() > 0)
                            @foreach ($user->roles as $role)
                                <span
                                    @if ($role->name === 'admin')
                                        @class(['bg-red-50', 'text-red-900', 'px-3', 'rounded-full', 'text-sm'])
                                    @elseif ($role->name === 'host')
                                        @class(['bg-yellow-50', 'text-yellow-900', 'px-3', 'rounded-full', 'text-sm'])
                                    @endif
                                >{{ $role->name }}</span>
                            @endforeach
                        @else
                            <span class="text-green-600 bg-green-50 px-3 rounded-full text-sm">user</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="w-[35%]">

            </div>
        </div>
    </div>
@endsection

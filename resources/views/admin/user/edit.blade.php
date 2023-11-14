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
            <div class="w-[60%] bg-white rounded drop-shadow p-5">
                <div class="w-[50%] mx-auto">
                    @if (!$user->hasMedia('avatar'))
                        <img src="{{ asset('avatar.png') }}" alt="{{ $user->username }}" class="w-[50%] bg-slate-700 rounded mx-auto">
                    @else
                        <img src="{{ $user->getFirstMediaUrl('avatar') }}" alt="{{ $user->username }}" class="w-[50%] rounded mx-auto">
                    @endif
                </div>

                <div class="mt-10">
                    <div class="w-full flex items-center space-x-5">
                        <div class="w-[50%]">
                            <input type="text" value="{{ $user->name }}" class="cursor-not-allowed bg-gray-50 border border-slate-300 py-2 px-2 rounded text-gray-700 text-sm w-full" disabled>
                        </div>
                        <div class="w-[50%]">
                            <input type="text" value="{{ $user->username }}" class="cursor-not-allowed bg-gray-50 border border-slate-300 py-2 px-2 rounded text-gray-700 text-sm w-full" disabled>
                        </div>
                    </div>
                    <div class="w-full mt-7">
                        <input type="text" value="{{ $user->email }}" class="cursor-not-allowed bg-gray-50 border border-slate-300 py-2 px-2 rounded text-gray-700 text-sm w-full" disabled>
                    </div>
                    <div class="mt-7">
                        @if ($user->roles->count() > 0)
                            <h3 class="text-sm uppercase text-gray-600 font-semibold">Tap on role to revoke role</h3>
                            <hr class="border border-gray-200 my-2">
                            <form action="{{ route('admin.user.revoke-role', $user->id) }}" method="POST" class="space-x-1.5">
                                @csrf
                                @method('DELETE')
                                <span class="text-green-600 bg-green-50 px-3 rounded-full text-sm">user</span>
                                @foreach ($user->roles as $role)
                                    <button type="submit" name="role" value="{{ $role->id }}">
                                        <span
                                            @if ($role->name === 'admin')
                                                @class(['bg-red-50', 'text-red-900', 'px-3', 'rounded-full', 'text-sm'])
                                            @elseif ($role->name === 'host')
                                                @class(['bg-yellow-50', 'text-yellow-900', 'px-3', 'rounded-full', 'text-sm'])
                                            @endif
                                        >{{ $role->name }}</span>
                                    </button>
                                @endforeach
                            </form>
                        @else
                            <span class="text-green-600 bg-green-50 px-3 rounded-full text-sm">user</span>
                        @endif
                    </div>
                    <div class="mt-10">
                        @if ($user->permissions->count() > 0)
                            <h3 class="text-sm uppercase text-gray-600 font-semibold">User Permissions</h3>
                            <hr class="border border-gray-200 my-2">
                            <form action="{{ route('admin.user.revoke-permission', $user->id) }}" method="POST" class="space-x-1.5 space-y-2">
                                @csrf
                                @method('DELETE')
                                @foreach ($user->permissions as $permission)
                                    <button type="submit" name="permission" value="{{ $permission->id }}">
                                        <span class="text-green-600 bg-green-50 px-3 rounded-full text-sm">{{ $permission->name }}</span>
                                    </button>
                                @endforeach
                            </form>
                        @endif
                    </div>
                    <div class="mt-10">
                        @if ($user->roles->count() > 0)
                            <h3 class="text-sm uppercase text-gray-600 font-semibold">Role Permissions</h3>
                            <hr class="border border-gray-200 my-2">
                            <div class="space-x-3">
                                @foreach ($allPermissions as $permission)
                                    <span class="text-sm mt-0.5 text-red-800 bg-red-50 px-3 rounded-full">{{ $permission->name }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="w-[37%]">
                <div class="w-full bg-white drop-shadow p-7 rounded">
                    <h3 class="font-semibold text-gray-700 text-lg">Roles</h3>
                    <form action="{{ route('admin.user.assign-role', $user->id) }}" method="POST">
                        @csrf
                        <div class="mt-1">
                            <select name="roles[]" id="roles" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                                <small class="text-red-800">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="bg-red-800 text-white px-4 py-1.5 rounded hover:bg-red-700 focus:outline focus:outline-red-800 focus:outline-offset-2">
                            Assign Role
                            </button>
                        </div>
                    </form>
                </div>
                <div class="mt-20 w-full bg-white drop-shadow p-7 rounded">
                    <h3 class="font-semibold text-gray-700 text-lg">Permissions</h3>
                    <form action="{{ route('admin.user.assign-permission', $user->id) }}" method="POST">
                        @csrf
                        <div class="mt-1">
                            <select name="permissions[]" id="permissions" multiple>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}" {{ $user->permissions->contains($permission->id) ? 'selected' : '' }}>{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            @error('permissions')
                                <small class="text-red-800">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="bg-red-800 text-white px-4 py-1.5 rounded hover:bg-red-700 focus:outline focus:outline-red-800 focus:outline-offset-2">
                            Assign Permission(s)
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        const roles = new MultiSelectTag('roles')
        const permissions = new MultiSelectTag('permissions')
    </script>
@endsection

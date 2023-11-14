<div>
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3 w-[20%]" x-data="{ paginate: @entangle('paginate') }">
            <p class="text-sm text-gray-700">
                Show
            </p>
            <select wire:model="pagination" id="" class="pl-2 py-1 bg-gray-50 border border-slate-200 rounded text-sm"
                x-model="paginate" @change="$wire.updatePerPage(paginate)">
                <option value="5" selected>5</option>
                <option value="10">10</option>
            </select>
            <p class="text-sm text-gray-700">
                Per Page
            </p>
        </div>

        <div class="w-[30%]">
            <input type="text" wire:model='search' placeholder="Search User" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:outline focus:outline-gray-300 focus:outline-offset-2 placeholder:text-sm">
        </div>
    </div>

    <div class="mt-7 relative overflow-x-auto border border-gray-300 sm:rounded-lg">
        <table class="w-full text-sm text-left">
            <thead class="uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-3 w-[10%] py-3">
                        Avatar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Roles
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="px-3 w-[10%] py-2">
                            @if ($user->hasMedia('avatar'))
                                <div>
                                    <img src="{{ $user->getFirstMediaUrl('avatar') }}" alt="{{ $user->username }}" class="w-[50%] bg-slate-700 rounded-lg">
                                </div>
                            @else
                                <div>
                                    <img src="{{ asset('avatar.png') }}" alt="{{ $user->username }}" class="w-[50%] bg-slate-700 rounded-lg">
                                </div>
                            @endif
                        </td>
                        <th scope="row" class="px-6 py-2 text-black font-medium whitespace-nowrap">
                            <a href="">
                                <h6 class="text-lg font-bold text-slate-950">{{ $user->name }}</h6>
                                <h6 class="mt-0.5 text-gray-500 text-sm">{{ $user->username }}</h6>
                            </a>
                        </th>
                        <td class="px-6 py-2">
                            <a href="{{ route('admin.user.edit', $user->id) }}">
                                <span class="underline underline-offset-2 text-blue-900">{{ $user->email }}</span>
                            </a>
                        </td>
                        <td class="px-6 py-2">
                            @if ($user->roles->count() > 0)
                                <span class="text-green-600 bg-green-50 px-3 rounded-full text-sm">user</span>
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

                        </td>
                        <td class="px-6 py-2">
                            <h2 class="font-bold text-gray-700">{{ $user->created_at->toFormattedDateString() }}</h2>
                            <small class="text-gray-500">{{ $user->created_at->diffForHumans() }}</small>
                        </td>
                        <td class="flex items-center px-6 py-2 space-x-3">
                        {{-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                            <form action="#" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this show?')"
                                    class="cursor-pointer bg-red-50 font-medium text-red-600 border border-red-400 p-2 flex items-center justify-between rounded-full hover:bg-red-100">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-10">
        {{-- {{ $genres->links() }} --}}
    </div>
</div>

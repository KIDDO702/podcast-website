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
            <input type="text" wire:model='search' placeholder="Search Show" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:outline focus:outline-gray-300 focus:outline-offset-2 placeholder:text-sm">
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
                    <th scope="col" class="px-6 py-3">
                        Show Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Host
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Published
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
                @foreach ($shows as $show)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-2 text-black font-medium whitespace-nowrap">
                            <a href="{{ route('admin.show.edit', $show->id) }}" class="underline underline-offset-2 text-blue-900">
                                {{ $show->title }}
                            </a>
                        </th>
                        <td class="px-6 py-2">
                            {{ $show->user->name }}
                        </td>
                        <td class="px-6 py-2">
                            @if($show->published)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @endif
                        </td>
                        <td class="px-6 py-2">
                            <h2 class="font-bold text-gray-700">{{ $show->created_at->toFormattedDateString() }}</h2>
                            <small class="text-gray-500">{{ $show->created_at->diffForHumans() }}</small>
                        </td>
                        <td class="flex items-center px-6 py-2 space-x-3">
                        {{-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                            <form action="{{ route('admin.show.destroy', $show->id) }}" method="post">
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
        {{ $shows->links() }}
    </div>
</div>

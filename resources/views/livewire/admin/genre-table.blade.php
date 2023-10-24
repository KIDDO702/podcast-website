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
            <input type="text" wire:model='search' placeholder="Search Genre" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded focus:outline focus:outline-gray-300 focus:outline-offset-2 placeholder:text-sm">
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
                        Genre Name
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
                @foreach ($genres as $genre)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-2 text-black font-medium whitespace-nowrap">
                            <a href="{{ route('admin.genre.edit', $genre->id) }}">
                                {{ $genre->name }}
                            </a>
                        </th>
                        <td class="px-6 py-2">
                            <h2 class="font-bold text-gray-700">{{ $genre->created_at->toFormattedDateString() }}</h2>
                            <small class="text-gray-500">{{ $genre->created_at->diffForHumans() }}</small>
                        </td>
                        <td class="flex items-center px-6 py-2 space-x-3">
                        {{-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                            <form action="{{ route('admin.genre.delete', $genre->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cursor-pointer bg-red-50 font-medium text-red-600 border border-red-400 p-2 flex items-center justify-between rounded-full hover:bg-red-100">
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
        {{ $genres->links() }}
    </div>
</div>



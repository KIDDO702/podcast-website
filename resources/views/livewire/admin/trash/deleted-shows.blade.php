<div>
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3" x-data="{ paginate: @entangle('paginate') }">
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
                    <th scope="col" class="px-2 py-3">
                        Show Title
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Deleted At
                    </th>
                    <th scope="col" class="px-2 py-3">
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
                        <th scope="row" class="px-2 py-1.5 text-black font-medium whitespace-nowrap">
                            <a class="text-blue-900 underline underline-offset-2">
                                {{ $show->title }}
                            </a>
                        </th>
                        <td class="px-2 py-1.5">
                            <h2 class="font-bold text-gray-700">{{ $show->deleted_at->toFormattedDateString() }}</h2>
                            <small class="text-gray-500">{{ $show->deleted_at->diffForHumans() }}</small>
                        </td>
                        <td class="flex items-center px-2 py-1.5 space-x-2">
                            <form wire:submit.prevent="restoreShow('{{ $show->id }}')" method="post">
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this episode?')"
                                    class="cursor-pointer bg-green-50 font-medium text-green-600 border border-green-400 p-1 flex items-center justify-between rounded-full hover:bg-green-100">
                                    <span class="material-symbols-outlined">
                                        restore_from_trash
                                    </span>
                                </button>
                            </form>
                            <form wire:submit.prevent="deleteShow('{{ $show->id }}')" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this episode?')"
                                    class="cursor-pointer bg-red-50 font-medium text-red-600 border border-red-400 p-1 flex items-center justify-between rounded-full hover:bg-red-100">
                                    <span class="material-symbols-outlined">
                                        delete_forever
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
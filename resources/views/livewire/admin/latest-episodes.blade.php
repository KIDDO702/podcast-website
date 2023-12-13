<div>
    <div class="mt-7 relative overflow-x-auto sm:rounded-lg">
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
                        Episode Title
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Show
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($episodes as $episode)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-2 py-1.5 text-black font-medium whitespace-nowrap">
                            <a href="{{ route('admin.episode.edit', $episode->id) }}" class="text-blue-900 underline underline-offset-2">
                                {{ $episode->title }}
                            </a>
                        </th>
                        <td class="px-2 py-1.5">
                            <h2 class="font-bold text-gray-700">{{ $episode->created_at->toFormattedDateString() }}</h2>
                        </td>
                        <td class="flex items-center px-2 py-1.5 space-x-2">
                            {{ $episode->show->title }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

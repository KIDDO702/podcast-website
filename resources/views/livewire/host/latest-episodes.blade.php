<div>
    <div class="mt-7 relative overflow-x-auto sm:rounded-lg border border-gray-600">
        <table class="w-full text-sm text-left">
            <thead class="uppercase bg-gray-600 text-gray-200">
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
            <tbody class="">
                @foreach ($episodes as $episode)
                    <tr class="bg-gray-800 border-b border-gray-600 hover:bg-gray-700">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-2 py-1.5 font-medium whitespace-nowrap">
                            <a class="text-yellow-400 underline underline-offset-2">
                                {{ $episode->title }}
                            </a>
                        </th>
                        <td class="px-2 py-1.5">
                            <h2 class="font-bold text-gray-200">{{ $episode->created_at->toFormattedDateString() }}</h2>
                        </td>
                        <td class="px-2 py-1.5 text-gray-200 font-medium whitespace-nowrap">
                            {{ $episode->show->title }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

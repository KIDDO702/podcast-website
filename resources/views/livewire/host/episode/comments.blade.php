<div class="w-full bg-slate-700 drop-shadow rounded p-7">
    <div class="mt-7 relative overflow-x-auto border border-gray-600 sm:rounded-lg">
        <table class="w-full text-sm text-left">
            <thead class="uppercase bg-gray-600">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-gray-300">
                        Body
                    </th>
                    <th scope="col" class="px-6 py-3 text-gray-300">
                        Comment's Owner
                    </th>
                    <th scope="col" class="px-6 py-3 text-gray-300">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3 text-gray-300">
                        Published
                    </th>
                    <th scope="col" class="px-6 py-3 text-gray-300">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3 text-gray-300">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr class="bg-gray-800 border-b border-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-2 font-medium whitespace-nowrap text-gray-300">
                            <a>
                                {{ $comment->body }}
                            </a>
                        </th>
                        <td class="px-6 py-2 text-gray-300">
                            {{ $comment->user->name }}
                        </td>
                        <td class="px-6 py-2 text-gray-300">
                            @if(!$comment->parent_id)
                                <span class="text-sm rounded-full bg-green-200 text-green-900 px-2 py-0.5">parent</span>
                            @else
                                <span class="text-sm rounded-full bg-yellow-200 text-yellow-900 px-2 py-0.5">reply</span>
                            @endif
                        </td>
                        <td class="px-6 py-2 text-gray-300">
                            @if($comment->approved)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @endif
                        </td>
                        <td class="px-6 py-2 text-gray-300">
                            <h2 class="font-bold text-gray-300">{{ $comment->created_at->toFormattedDateString() }}</h2>
                            <small class="text-gray-400">{{ $comment->created_at->diffForHumans() }}</small>
                        </td>
                        <td class="flex items-center px-6 py-2 space-x-3">
                        {{-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                            <form action="#" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this episode?')"
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
        {{ $comments->links() }}
    </div>
</div>


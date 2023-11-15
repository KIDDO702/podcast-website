<div>
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-yellow-400 text-3xl font-bold">Shows</h3>
        </div>
        <div>
            <a href="" class="bg-red-800 px-4 py-2 rounded text-white focus:outline focus:outline-red-800 focus:outline-offset-2 hover:bg-red-700">
                View all
            </a>
        </div>
    </div>
    <div class="w-full mt-7 grid grid-cols-2 md:grid-cols-3 gap-5">
        @foreach ($shows as $show)
            <div class="bg-gray-900 rounded drop-shadow">
                <div class="p-3">
                    <img src="{{ $show->getFirstMediaUrl('show_thumbnail') }}" alt="{{ $show->slug }}" class="rounded">
                </div>
                <div class="pb-4 px-4">
                    <div class="flex items-center mt-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-yellow-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-yellow-400 ml-2">{{ $show->user->name }}</span>
                        </div>

                    </div>
                    <h3 class="text-gray-100 text-2xl tracking-[1px] font-semibold my-3">{{ $show->title }}</h3>
                    {{-- <span class="text-yellow-300 mt-1 text-sm">{{ $show->user->name }}</span> --}}
                    <p class="text-sm text-white font-light">{{ Str::limit(strip_tags($show->description), 100, '...')}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

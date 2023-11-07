<div class="w-full mt-10 flex items-start space-x-10">
    <div class="w-[25%] sticky top-28 border-r border-gray-300 px-5">
        <div class="w-full flex justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-200">My shows</h3>
            </div>
            <a href="{{ route('host.show.create') }}" class="bg-red-800 text-white rounded flex items-center justify-center px-3 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <span class="text-white text-sm ml-2">New Show</span>
            </a>
        </div>
        <div class="space-y-7 mt-16">
            @foreach ($shows as $show)
                <div class="flex items-start space-x-7">
                    <div class="w-[25%]">
                        <img src="{{ $show->getFirstMediaUrl('show_thumbnail') }}" alt="{{ $show->slug }}">
                    </div>
                    <div class="w-[70%]">
                        <a wire:click="selectShow('{{ $show->id }}')" class="cursor-pointer text-white text-xl font-semibold">{{ $show->title }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="w-[70%] pb-16">
        @if (!$selectedShow)
            <h3 class="text-gray-200">No show selected</h3>
        @else
            @php
                $count = 1;
            @endphp
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="font-semibold text-gray-300 text-4xl">{{ $selectedShow->title }} Episodes</h3>
                </div>

                <div>
                    <a href="{{ route('host.episode.create', $selectedShow->slug) }}" class="bg-red-800 text-white px-4 py-2 rounded focus:outline focus:outline-red-600 focus:outline-offs">Add Episode</a>
                </div>
            </div>
            <hr class="border-slate-300 my-7">
            <div class="grid grid-cols-4 gap-4">
                @foreach ($selectedShow->episode as $selectedEpisode)
                    <div class="bg-slate-700 rounded drop-shadow transition-all group group-hover:drop-shadow-lg">
                        <div class="p-3">
                            <img src="{{ $selectedEpisode->getFirstMediaUrl('episode_thumbnail') }}" alt="{{ $selectedEpisode->slug }}"     class="mx-auto h-[50%] rounded">
                        </div>
                        <div class="py-3 px-4 w-full">
                            <span class="font-semibold text-gray-300">Episode {{ $count++ }}</span>
                            <div class="mt-0.5">
                                <a href="{{ route('host.episode.edit', ['show' => $selectedShow->slug, 'episode' => $selectedEpisode->slug]) }}" class="text-gray-200 text-2xl uppercase font-bold">{{ $selectedEpisode->title }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

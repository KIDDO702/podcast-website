<div class="w-full mt-10 flex items-start space-x-10">
    <div class="w-[25%] sticky top-28 border-r border-gray-300">
        <div class="space-y-7">
            @foreach ($shows as $show)
                <div class="flex items-start space-x-7 {{ $selectedShow == $show->id ? 'bg-slate-700' : '' }}">
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
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="font-semibold text-gray-300 text-4xl">{{ $selectedShow->title }} Episodes</h3>
                </div>

                <div>
                    <a href="#" class="bg-red-800 text-white px-4 py-2 rounded focus:outline focus:outline-red-600 focus:outline-offs">Add Episode</a>
                </div>
            </div>
            @foreach ($selectedShow->episode as $selectedEpisode)
                <div class="bg-slate-700 mt-7 flex items-start space-x-7">
                    <div class="w-[20%] p-3">
                        <img src="{{ $selectedEpisode->getFirstMediaUrl('episode_thumbnail') }}" alt="{{ $selectedEpisode->slug }}" class="w-full rounded">
                    </div>
                    <div class="py-3 px-4 w-full">
                        <h3 class="text-gray-200 text-3xl uppercase font-bold">{{ $selectedEpisode->title }}</h3>
                        <div class="mt-7 w-full">
                            <audio controls class="w-full">
                                <source src="{{ $selectedEpisode->getFirstMedia('audio')->getUrl() }}" type="{{ $selectedEpisode->getFirstMedia('audio')->mime_type }}">
                            </audio>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

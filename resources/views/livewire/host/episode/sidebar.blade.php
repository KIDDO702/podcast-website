<div class="text-gray-200 h-full w-full px-3 mt-5">
    <h3 class="text-xl font-semibold ">My shows</h3>
    <ul class="mt-5 space-y-3">
        @foreach ($shows as $show)
            <li class="block px-4 py-3 w-full bg-slate-700 drop-shadow-sm rounded">
                <a class="cursor-pointer" wire:click="$emit('showSelected', '{{ $show->id }}')">
                    <div class="flex items-start space-x-5">
                        <div class="w-[30%]">
                            <img src="{{ $show->getFirstMediaUrl('show_thumbnail') }}" alt="{{ $show->slug }}" class="w-full">
                        </div>
                        <div class="w-[70%]">
                            <span class="text-xl font-semibold">
                                {{ $show->title }}
                            </span>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</div>

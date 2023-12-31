<div class="">
    <div>
        <h3 class="text-yellow-400 text-3xl font-bold">Genres</h3>
    </div>

    <div class="bg-gray-900 w-full p-7 rounded drop-shadow mt-7">
        <ul class="grid grid-cols-3 md:grid-cols-2 place-content-center text-white">
            @foreach ($genres as $genre)
                <li class="block py-1.5">
                    <a href="{{ route('user.genre', $genre->slug) }}">{{ $genre->name }}</a>
                </li>
            @endforeach
        </ul>

        <div class="flex items-center justify-center mt-7">
            <button wire:click="loadMore" class="text-yellow-600 text-sm font-semibold">Load More</button>
        </div>
    </div>
</div>

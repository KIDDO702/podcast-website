<div class="grid grid-cols-4 gap-5 mt-5">
    @foreach($episodes as $episode)
        <div class="relative">
            <div class="w-full relative">
                <img src="{{ $episode->getFirstMediaUrl('episode_thumbnail') }}" class="rounded">
                <div class="w-full absolute inset-0 bg-slate-950 bg-opacity-30"></div>
            </div>
            <div class="mt-3">
                <h3 class="text-3xl text-gray-300 font-semibold">{{ $episode->title }}</h3>
            </div>
            <div class="w-full absolute rounded drop-shadow top-5 flex items-center justify-between px-4">
                <form method="POST" action="{{ route('host.restore-episode', $episode->id) }}">
                    @csrf
                    <button type="submit" class="bg-opacity-40 bg-green-600 flex items-center p-4 rounded-md drop-shadow hover:bg-opacity-80">
                        <span class="material-symbols-outlined text-white">
                            restore_from_trash
                        </span>
                    </button>
                </form>
                <form method="POST" action="{{ route('host.delete-episode', $episode->id) }}">
                    @csrf
                    <button onclick="return confirm('Are you sure you want to delete this '.{{ $episode->title }})" type="submit" class="bg-opacity-40 bg-red-600 flex items-center p-4 rounded-md drop-shadow hover:bg-opacity-80">
                        <span class="material-symbols-outlined text-white">
                            delete_forever
                        </span>
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>

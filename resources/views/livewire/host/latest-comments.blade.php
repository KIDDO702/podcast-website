<div class="grid gap-2.5">
    @foreach (auth()->user()->episodesWithComments as $comment)
        <div class="w-full bg-slate-950 rounded px-4 py-2 drop-shadow border-l-4 border-yellow-600">
            <div>
                <small class="text-yellow-400">{{ $comment->user->name }}</small>
            </div>
            <div>
                <h3 class="text-gray-200 font-semibold text-lg">{{ $comment->body }}</h3>
                <span class="text-red-600 font-semibold mt-0.5">{{ $comment->episode->title }}</span>
            </div>
        </div>
    @endforeach
</div>

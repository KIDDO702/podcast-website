<div class="mt-5 grid md:grid-cols-2 lg:grid-cols-5 gap-5">
    @foreach ($comments as $comment)
        <div class="w-full bg-slate-500 border border-slate-500 rounded p-5">
            <div class="w-full flex justify-between">
                <span class="font-semibold text-yellow-400">{{ $comment->user->username }}</span>
                <span class="text-sm text-gray-300 font-light">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="w-full my-7">
                <h3 class="text-gray-50">{{ $comment->body }}</h3>
            </div>
            <div class="w-full">
                <h6 class="font-semibold text-yellow-400">{{ $comment->episode->title }}</h6>
                <small class="text-yellow-50 font-semibold">{{ $comment->episode->show->title }}</small>
            </div>
        </div>
    @endforeach
</div>

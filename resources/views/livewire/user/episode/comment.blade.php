<div class="w-full">
    <div class="">
        <h3 class="text-gray-200">Comment as <span class="text-yellow-400 font-semibold">{{ Auth::user()->username }}</span></h3>
    </div>

    <form action="{{ route('comment', $episode->slug) }}" method="post" class="w-full mt-5">
        @csrf
        <div class="w-full">
            <textarea name="comment" id="comment" placeholder="Comment" cols="30" rows="4" class="w-full text-sm text-gray-200 bg-slate-950  border border-slate-900 rounded p-3 focus:outline focus:outline-slate-950 focus:outline-offset-2 placeholder:text-sm placeholder:text-gray-200"></textarea>
            @error('comment')
                <small>{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-7">
            <button type="submit" class="bg-yellow-600 text-red-800 font-semibold px-4 py-2 rounded drop-shadow hover:bg-yellow-500 focus:outline focus:outline-offset-2 focus:outline-yellow-600">
                Comment
            </button>
        </div>
    </form>
</div>

<div class="w-full">
    <div class="">
        <h3 class="text-gray-200">Comment as <span class="text-yellow-400 font-semibold">{{ Auth::user()->username }}</span></h3>

        <form action="#" class="mt-5">
            <div class="w-full h-[30%]">
                <input type="text" placeholder="Comment" class="w-full bg-slate-950 px-4 py-3 h-full border-slate-900 rounded focus:outline focus:outline-slate-950 focus:outline-offset-2">
            </div>
            {{ $episode }}
        </form>
    </div>
</div>

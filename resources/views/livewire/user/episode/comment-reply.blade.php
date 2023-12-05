<div class="w-full">
    <h3 class="my-2 text-sm text-gray-200 font-semibold">Reply as <span class="text-yellow-400">{{ Auth::user()->username }}</span></h3>
    <form class="w-full" wire:submit.prevent="reply">
        <div class="w-full">
            <input type="text" wire:model="body" placeholder="Reply" class="w-full bg-slate-950 text-gray-200 text-sm px-4 py-2 rounded focus:outline focus:outline-offset-2 focus:outline-slate-950 placeholder:text-sm placeholder:text-gray-200">
            @error('body')
                <small class="text-gray-200 font-semibold">{{ $message }}</small>
            @enderror
        </div>
        <div class="w-full mt-5">
            <button type="submit" class="bg-yellow-600 text-red-800 px-3 py-2 rounded font-semibold focus:outline focus:outline-offset-2 focus:outline-yellow-600 hover:bg-yellow-500">
                Reply
            </button>
        </div>
    </form>
</div>

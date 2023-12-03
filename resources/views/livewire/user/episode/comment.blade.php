<div class="w-full">
    <div class="">
        <h3 class="text-gray-200">Comment as <span class="text-yellow-400 font-semibold">{{ Auth::user()->username }}</span></h3>
    </div>

    <form wire:submit.prevent="comment" class="w-full mt-5">
        @csrf
        <textarea wire:model="body" placeholder="Comment" cols="30" rows="4" class="w-full bg-slate-950 rounded p-4 text-gray-200 text-sm focus:outline focus:outline-slate-950 focus:outline-offset-2 placeholder:text-gray-200 placeholder:text-sm"></textarea>
        @error('body')
            <small class="font-semibold text-gray-200">{{ $message }}</small>
        @enderror

        <div class="mt-5">
            <button type="submit" class="bg-yellow-600 text-red-800 px-4 py-2 rounded font-semibold focus:outline focus:outline-offset-2 focus:outline-yellow-600 hover:bg-yellow-500">
                Comment
            </button>
        </div>
    </form>
</div>

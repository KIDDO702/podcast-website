<div>
    <form wire:submit.prevent="submit">
        <div>
            <input type="text" placeholder="Entertainmanet" wire:model='name' class="w-full bg-gray-50 border border-slate-200 rounded-sm px-4 py-2 focus:outline focus:outline-slate-400 focus:outline-offset-2">
            @error('name')
                <small class="text-red-800 font-semibold">{{ $message }}</small>
            @enderror
        </div>

        <div class="mt-7">
            <button type="submit" class="bg-slate-900 text-white px-4 py-2 font-semibold rounded focus:ring focus:ring-slate-900 focus:ring-offset-2">
                Create
            </button>
        </div>
    </form>
</div>

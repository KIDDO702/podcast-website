<div>
    <div class="bg-slate-700 w-full rounded drop-shadow-sm mt-16">
        <form wire:submit.prevent="submit" class="p-7">
            <div class="w-full">
                <input type="text" placeholder="Genre e.g. Entertainment" wire:model="name" class="w-full text-gray-50 bg-slate-800 px-4 py-2 border border-slate-900 rounded focus:outline focus:outline-slate-900 focus:outline-offset-2">
                @error('name')
                    <small class="font-semibold text-red-50">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-7">
                <button type="submit" class="bg-slate-900 text-gray-50 px-4 py-1.5 rounded focus:outline focus:outline-slate-900 focus:outline-offset-2">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>

@extends('layout.admin')

@section('body')
    <div class="bg-white rounded drop-shadow-sm flex justify-between items-center py-2 px-4">
        <h3 class="font-bold text-slate-900 text-2xl">Shows</h3>


        <ul class="flex items-center space-x-3">
            <li>
                <a href="{{ route('admin.index') }}" class="text-red-800 underline underline-offset-1">
                    <small class="font-semibold">Dashboard</small>
                </a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 flex items-center justify-center">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>

            </li>
            <li>
                <a href="{{ route('admin.show') }}" class="text-red-800 underline underline-offset-1">
                    <small class="font-semibold">Shows</small>
                </a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 flex items-center justify-center">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </li>
             <li>
                <small class="text-gray-600 font-semibold">Create</small>
            </li>
        </ul>
    </div>

    <div class="mt-10">
        <form action="" class="flex items-start space-x-10">
            <div class="w-[70%]">
                <div class="bg-white p-7 rounded drop-shadow-sm w-full">
                    <div class="w-full">
                        <input type="text" name="title" id="title" placeholder="Title e.g. Walk with Bob" class="w-full bg-gray-50 border border-slate-300 px-4 py-2 rounded focus:outline focus:outline-slate-300 focus:outline-offset-2 placeholder:text-sm">
                    </div>
                    <div class="mt-7">
                        <textarea name="" cols="30" id="description" rows="10" class="w-full bg-gray-50 border border-slate-300 px-4 py-2 rounded focus:outline focus:outline-slate-300 focus:outline-offset-2 placeholder:text-sm"></textarea>
                    </div>
                </div>
                <div class="mt-5 bg-white p-7 rounded drop-shadow-sm w-full">
                    <div class="w-full">
                        <input type="file" name="" id="" class="w-full">
                    </div>
                </div>
            </div>
            <div class="w-[30%] bg-white p-7 rounded drop-shadow-sm">
                <div>
                    <label for="genres" class="font-semibold text-gray-700">Genres</label>
                    <div class="mt-1.5">
                        <select name="genres[]" id="genres" multiple>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr class="border border-slate-400 my-7">
                <div>
                    <h3>Featured</h3>
                </div>
                <div class="w-full mt-3">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="featured" value="1" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-yellow-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Visible</span>
                    </label>
                    <h3 class="text-sm font-light mt-5">This show will be hidden from all podcast channels. </h3>
                </div>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    <script>
        new MultiSelectTag('genres')
     </script>
@endsection

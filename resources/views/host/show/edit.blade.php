@extends('layout.host')

@section('body')
    <section class="py-16">
        <div class="container">
            <form action="{{ route('host.show.update', $show->id) }}" method="POST" class="w-full" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-slate-700 rounded p-7">
                    <div>
                        <h3>
                            <span class="text-gray-300 font-semibold">Title & Description</span>
                        </h3>
                    </div>
                    <div class="w-full mt-5">
                        <input type="text" value="{{ $show->title }}" placeholder="Title e.g. Walk with sindy" name="title" class="w-full bg-slate-900 px-4 py-2 rounded text-gray-300 placeholder:text-gray-300 focus:outline focus:outline-yellow-600 focus:outline-offset-2">
                        @error('title')
                            <small class="text-red-300 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mt-7">
                        <textarea name="description" id="description" cols="30" rows="10" class="w-full bg-slate-900 px-4 py-2 rounded text-gray-300 placeholder:text-gray-300 focus:outline focus:outline-yellow-600 focus:outline-offset-2">
                            {{ $show->description }}
                        </textarea>
                        @error('description')
                            <small class="text-red-300 font-semibold">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mt-16 bg-slate-700 rounded p-7" x-data="{ preview: false }">
                    <div class="mt-3">
                        <a class="cursor-pointer" @click="preview = !preview">
                            <small class="text-sm text-red-800 underline underline-offset-2" x-text="preview ? 'Hide Preview' : 'Show Preview'">
                            </small>
                        </a>
                    </div>
                    <div class="w-full bg-gray-200 my-3" x-show="preview" x-cloak x-transition>
                        @if($show->hasMedia('show_thumbnail'))
                            <img src="{{ $show->getFirstMediaUrl('show_thumbnail') }}" alt="{{ $show->slug }}" class="mx-auto w-[30%]">
                        @endif
                    </div>
                    <div class="w-full">
                        <label for="thumbnail" class="font-semibold text-gray-300">Thumbnail</label>
                        <input type="file" name="thumbnail" placeholder="Thumbnail" class="w-full mt-1.5 bg-slate-900 px-4 py-2 rounded text-gray-300 placeholder:text-gray-300 focus:outline focus:outline-yellow-600 focus:outline-offset-2">
                    </div>
                    <div class="w-full mt-7">
                        <div>
                            <label for="genres" class="font-semibold text-gray-300">Genres</label>
                            <div class="mt-1.5">
                                <select name="genres[]" id="genres" multiple>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}" {{ $show->genre->contains($genre->id) ? 'selected' : '' }}>{{ $genre->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <hr class="border border-slate-400 my-7"> --}}
                        <div class="mt-7">
                            <h3 class="font-semibold text-gray-300">Published</h3>
                        </div>
                        <div class="w-full text-gray-300 font-semibold mt-1.5">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="published" value="1" class="sr-only peer" {{ $show->published ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-red-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-800"></div>
                                <span class="ml-3 text-sm font-medium text-gray-300">Visible</span>
                            </label>
                            <h3 class="text-sm mt-5 font-semibold">This show will be hidden from all podcast channels. </h3>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-between">
                    <div>
                        <button type="submit" class="px-4 py-2 rounded bg-red-900 text-yellow-600 font-semibold focus:outline focus:outline-slate-700 focus:outline-offset-2 hover:bg-red-800">
                            Edit show
                        </button>
                    </div>

                </div>
            </form>
            <form action="{{ route('host.show.delete', $show->id) }}" method="POST" class="mt-5">
                @csrf
                @method('DELETE')
                <button
                    onclick="return confirm('Are you sure you want to delete this show?')"
                    class="bg-red-600 text-white p-3 rounded-full flex items-center justify-center border border-red-900">
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                </button>
            </form>
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        new MultiSelectTag('genres')
    </script>
@endsection

@extends('layout.host')


@section('body')
    <section class="py-16">
        <div class="container">
            <form action="{{ route('host.episode.store', $show->slug) }}" method="POST" class="w-full" enctype="multipart/form-data">
                @csrf
                <div class="w-full">
                    <div class="w-full bg-slate-700 p-7 rounded drop-shadow-sm">
                        <h3 class="text-gray-300 font-semibold text-lg">Title & Description</h3>
                        <div class="w-full flex items-center space-x-7 mt-3">
                            <div class="w-[50%]">
                                <input type="text" name="title" id="title" placeholder="Title e.g Episode One" class="w-full bg-slate-900 text-gray-300 px-4 py-2 rounded placeholder:text-gray-200 focus:outline focus:outline-slate-950 focus:outline-offset-2">
                                @error('title')
                                    <small class="font-semibold text-slate-200">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-[50%]">
                                <input type="text" name="show" id="title" value="{{ $show->title }}" placeholder="Title e.g Episode One" class="cursor-not-allowed w-full bg-slate-900 text-gray-300 px-4 py-2 rounded placeholder:text-gray-200" disabled>
                            </div>
                        </div>

                        <div class="mt-7">
                            <textarea name="description" id="description" cols="30" rows="10" class="w-full bg-slate-900 px-4 py-2 rounded text-gray-300 placeholder:text-gray-300 focus:outline focus:outline-yellow-600 focus:outline-offset-2"></textarea>
                            @error('description')
                                <small class="text-red-300 font-semibold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-16 flex items-start space-x-10">
                        <div class="w-[50%] bg-slate-700 p-7 rounded drop-shadow">
                            <div class="w-full">
                                <label for="thumbnail" class="font-semibold text-slate-200">Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="w-full mt-1 border border-slate-950 bg-slate-900 text-gray-300 px-4 py-2 rounded placeholder:text-gray-200 focus:outline focus:outline-slate-950 focus:outline-offset-2">
                                @error('thumbnail')
                                    <small class="font-semibold text-slate-200">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full mt-7">
                                <label for="thumbnail" class="font-semibold text-slate-200">Audio File</label>
                                <input type="file" name="audio" id="audio" class="w-full mt-1 border border-slate-950 bg-slate-900 text-gray-300 px-4 py-2 rounded placeholder:text-gray-200 focus:outline focus:outline-slate-950 focus:outline-offset-2">
                                @error('audio')
                                    <small class="font-semibold text-slate-200">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mt-7">
                                <h3 class="font-semibold text-gray-300">Published</h3>
                            </div>
                            <div class="w-full text-gray-300 font-semibold mt-1.5">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="published" value="1" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-red-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-800"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-300">Visible</span>
                                </label>
                                <h3 class="text-sm mt-5 font-semibold">This show will be hidden from all podcast channels. </h3>
                            </div>
                        </div>
                        <div class="w-[50%] bg-slate-700 p-7 rounded drop-shadow">
                            <div class="w-full">
                                <label for="youtube_link" class="font-semibold text-slate-200">YouTube Link</label>
                                <input type="text" name="youtube_link" id="youtube_link" placeholder="https://www.youtube.com/watch?v=5PfEQTBrlJU" class="w-full mt-1 bg-slate-900 text-gray-300 px-4 py-2 rounded placeholder:text-gray-400 focus:outline focus:outline-slate-950 focus:outline-offset-2">
                                @error('youtube_link')
                                    <small class="font-semibold text-slate-200">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full mt-7">
                                <label for="spotify_link" class="font-semibold text-slate-200">Spotify Link</label>
                                <input type="text" name="spotify_link" id="spotify_link" placeholder="https://www.youtube.com/watch?v=5PfEQTBrlJU" class="w-full mt-1 bg-slate-900 text-gray-300 px-4 py-2 rounded placeholder:text-gray-400 focus:outline focus:outline-slate-950 focus:outline-offset-2">
                                @error('spotify_link')
                                    <small class="font-semibold text-slate-200">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <button type="submit" class="bg-red-800 text-yellow-400 px-4 py-2 rounded hover:bg-red-700 focus:outline focus:outline-red-800 focus:outline-offset-2">
                            Create Episode
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

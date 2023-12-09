@extends('layout.admin')

@section('body')
    <div class="bg-white rounded drop-shadow flex justify-between items-center py-2 px-4">
        <h3 class="font-bold text-slate-900 text-2xl">Episodes</h3>


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
                <a href="{{ route('admin.episode') }}" class="text-red-800 underline underline-offset-1">
                    <small class="font-semibold">Episodes</small>
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
        <form action="{{ route('admin.episode.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="lg:flex lg:space-x-7 lg:items-start">
                <div class="lg:w-[65%] w-full">
                    <div class="w-full bg-white drop-shadow rounded p-5">
                        <div class="w-full">
                            <label for="title" class="text-sm text-gray-700 font-semibold">Title</label>
                            <input type="text" name="title" id="title" value="{{ $episode->title }}" class="w-full mt-1 bg-gray-50 border border-slate-300 px-4 py-2 rounded focus:outline focus:outline-gray-400 focus:outline-offset-2 placeholder:text-sm">
                            @error('title')
                                <small class="font-semibold text-red-800">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-7">
                            <label for="show" class="text-sm text-gray-700 font-semibold">Show</label>
                            <select name="show" id="show" class="w-full mt-1 bg-gray-50 border border-slate-300 px-4 py-2 rounded">
                                {{-- <option selected>Show</option> --}}
                                @foreach ($shows as $show)
                                    <option value="{{ $show->id }}" {{ $episode->show_id == $show->id ? 'selected' : '' }}>{{ $show->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-7">
                            <textarea name="description" id="description" class="w-full bg-gray-50 border border-slate-300 px-4 py-2 rounded focus:outline focus:outline-slate-300 focus:outline-offset-2 placeholder:text-sm">
                                {{ $episode->description }}
                            </textarea>
                            @error('description')
                                <small class="text-red-800 font-semibold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full mt-10 bg-white drop-shadow rounded p-5" x-data="{ preview: true }">
                        <div class="w-full bg-gray-200 my-3" x-show="preview" x-cloak x-transition>
                            @if($episode->hasMedia('episode_thumbnail'))
                                <img src="{{ $episode->getFirstMediaUrl('episode_thumbnail') }}" alt="{{ $episode->slug }}" class="mx-auto w-[50%]">
                            @endif
                        </div>
                        <div class="w-full">
                            <label for="thumbnail" class="font-semibold">Thumbnail</label>
                            <input type="file" id="thumbnail" name="thumbnail" class="w-full mt-1.5 bg-gray-50 border border-slate-300 px-4 py-2 rounded focus:outline focus:outline-gray-400 focus:outline-offset-2 placeholder:text-sm">
                        </div>
                        <div class="w-full mt-7">
                            <label for="audio" class="font-semibold">Audio File</label>
                            <input type="file" id="audio" name="audio" class="w-full mt-1.5 bg-gray-50 border border-slate-300 px-4 py-2 rounded focus:outline focus:outline-gray-400 focus:outline-offset-2 placeholder:text-sm">
                        </div>
                        <div class="mt-5 w-full">
                            @if($episode->hasMedia('audio'))
                                <audio controls class="w-full">
                                    <source src="{{ $audioFile->getUrl() }}" type="{{ $audioFile->mime_type }}">
                                </audio>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-10 w-full lg:mt-0 lg:w-[35%]">
                    <div class="bg-white drop-shadow w-full rounded p-5">
                        <div>
                            <h3>Featured</h3>
                        </div>
                        <div class="w-full mt-2">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="published" value="1" class="sr-only peer" {{ $show->published ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-red-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-800"></div>
                                <span class="ml-3 text-sm font-medium text-gray-900">Visible</span>
                            </label>
                            <h3 class="text-sm font-light mt-5">This show will be hidden from all podcast channels. </h3>
                        </div>
                    </div>

                    <div class="mt-10 bg-white drop-shadow w-full rounded p-5">
                        <div class="w-full">
                            <label for="youtube_link" class="text-sm text-gray-700 font-semibold">Youtube Link</label>
                            <input type="text" name="youtube_link" value="{{ $episode->youtube_link }}" id="youtube_link" class="w-full mt-1 bg-gray-50 border border-slate-300 px-4 py-1 rounded focus:outline focus:outline-gray-400 focus:outline-offset-2 placeholder:text-sm">
                        </div>
                        <div class="w-full mt-5">
                            <label for="spotify_link" class="text-sm text-gray-700 font-semibold">Spotify Link</label>
                            <input type="text" value="{{ $episode->spotify_link }}" name="spotify_link" id="spotify_link" class="w-full mt-1 bg-gray-50 border border-slate-300 px-4 py-1 rounded focus:outline focus:outline-gray-400 focus:outline-offset-2 placeholder:text-sm">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12">
                <button type="submit" class="bg-red-800 text-white px-4 py-2.5 rounded focus:ring focus:ring-red-800 focus:ring-offset-2">
                    Edit Episode
                </button>
            </div>
        </form>
    </div>

    <hr class="border-gray-200 my-10">

    <div>
        <livewire:admin.episode.comments-table :episode="$episode" />
    </div>
@endsection

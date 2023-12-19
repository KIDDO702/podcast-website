@extends('layout.admin')

@section('body')
    <div class="bg-white rounded drop-shadow-sm flex justify-between items-center py-2 px-4">
        <h3 class="font-bold text-slate-900 text-2xl">Episode Comments</h3>

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
                <a href="{{ route('admin.episode.edit', $episode->id) }}" class="text-red-800 underline underline-offset-1">
                    <small class="font-semibold">{{ $episode->title }}</small>
                </a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 flex items-center justify-center">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </li>
             <li>
                <small class="text-gray-600 font-semibold">Comment</small>
            </li>
        </ul>
    </div>

    <div class="mt-10 bg-white drop-shadow-sm rounded p-7 border border-slate-100">
        <form action="{{ route('admin.episode.coment-edit', ['id' => $episode->id, 'comment' => $comment->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="w-full grid grid-cols-2 gap-4">
                <div class="w-full">
                    <label for="user" class="text-sm font-semibold text-gray-700">User</label>
                    <input type="text" id="user" value="{{ $comment->user->name }}" class="cursor-not-allowed w-full text-sm bg-gray-100 border border-gray-200 rounded text-gray-900 mt-1 px-2 py-2" disabled>
                </div>
                <div class="w-full">
                    <label for="episode" class="text-sm font-semibold text-gray-700">Episode</label>
                    <input type="text" id="episode" value="{{ $comment->episode->title }}" class="cursor-not-allowed w-full text-sm bg-gray-100 border border-gray-200 rounded text-gray-900 mt-1 px-2 py-2" disabled>
                </div>
            </div>
            <div class="mt-7">
                <label for="body" class="text-sm font-semibold text-gray-700">Body</label>
                <textarea name="body" id="body" cols="30" rows="5" class="w-full text-sm bg-gray-100 border border-gray-200 rounded text-gray-900 mt-1 px-2 py-2 focus:outline focus:outline-gray-300 focus:outline-offset-2">{{ $comment->body }}</textarea>
            </div>
            <div class="mt-7">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="approved" value="1" class="sr-only peer" {{ $comment->approved ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-red-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-800"></div>
                    <span class="ml-3 text-sm font-medium text-gray-900">Visible</span>
                </label>
            </div>

            <div class="mt-7">
                <button type="submit" class="bg-red-800 text-yellow-400 font-semibold px-4 py-2 rounded focus:outline focus:outline-offset-2 focus:outline-red-800">
                    Edit Comment
                </button>
            </div>
        </form>
    </div>
@endsection

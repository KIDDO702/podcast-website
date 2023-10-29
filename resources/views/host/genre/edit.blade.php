@extends('layout.host')

@section('body')
    <section>
        <div class="container mx-auto">
            <div class="bg-slate-700 w-full rounded drop-shadow-sm mt-16">
                <form class="p-7" action="{{ route('host.genre.update', $genre->slug) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="w-full">
                        <input type="text" value="{{ $genre->name }}" placeholder="Genre e.g. Entertainment" name="name" class="w-full text-gray-50 bg-slate-800 px-4 py-2 border border-slate-900 rounded focus:outline focus:outline-slate-900 focus:outline-offset-2">
                        @error('name')
                            <small class="font-semibold text-red-50">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mt-7">
                        <button type="submit" class="bg-slate-900 text-gray-50 px-4 py-1.5 rounded focus:outline focus:outline-slate-900 focus:outline-offset-2">
                            Edit
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-slate-700 w-full  p-7 mt-16 rounded">
                <h3 class="text-slate-200 font-bold text-xl">My Genres</h3>
                <hr class="border-slate-200 mt-3 mb-4">
                <ul class="w-full grid grid-cols-3">
                    @foreach ($userGenres as $genreUser)
                        <li class="block py-1.5">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('host.genre.edit', $genreUser->slug) }}" class="text-slate-200 font-semibold">{{ $genreUser->name }}</a>
                                <form action="{{ route('host.genre.delete', $genreUser->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500"
                                        onclick="return confirm('Are you sure you want to delete this genre?')" >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection

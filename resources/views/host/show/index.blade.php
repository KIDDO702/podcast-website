@extends('layout.host')

@section('body')
    <section class="pt-16 pb-10">
        <div class="container px-5 md:px-3 lg:px-0">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-gray-300">My Shows</h3>
                </div>

                <div>
                    <a href="{{ route('host.show.create') }}" class="bg-red-800 text-white px-4 py-1.5 rounded focus:outline focus:outline-red-800 focus:outline-offset-2">Create Show</a>
                </div>
            </div>
            <div class="mt-7 grid md:grid-cols-2 lg:grid-cols-4 place-items-center place-content-center gap-4 lg:gap-6">
                @foreach ($userShows as $show)
                    <div class="drop-shadow-sm">
                        @if ($show->hasMedia('show_thumbnail'))
                            <div class="relative">
                                <img src="{{ $show->getFirstMediaUrl('show_thumbnail') }}" alt="{{ $show->slug }}">
                                <div class="absolute inset-0 bg-black bg-opacity-25 flex items-end">
                                    <div class="bg-yellow-600 bg-opacity-60 w-full text-center text-white font-semibold">
                                        {{ count($show->episode) }} Episodes
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mt-3">
                            <div>
                                <a href="{{ route('host.show.edit', $show->slug) }}" class="text-slate-300 text-2xl font-semibold">{{ $show->title }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

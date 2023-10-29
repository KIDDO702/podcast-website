@extends('layout.host')

@section('body')
    <section class="pt-16">
        <div class="container">
            <div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-300">My Shows</h3>
                </div>
            </div>
            <div class="mt-5 grid grid-cols-4 place-items-center place-content-center gap-6">
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

                        <div class="pt-3">
                            <div>
                                <a href="{{ route('host.show.edit', $show->slug) }}" class="text-slate-300 text-2xl font-semibold">{{ $show->title }}</a>
                                <p class="text-white font-light"></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@extends('layout.home')

@section('body')
    <section class="pt-10 pb-20">
        <div class="container px-5 md:px-3 lg:px-0">
            <div>
                <ul class="flex items-center space-x-3">
                    <li>
                        <a href="/" class="text-yellow-400 underline underline-offset-2">
                            Home
                        </a>
                    </li>
                    <li>
                        <span class="text-white font-bold">
                            .
                        </span>
                    </li>
                    <li>
                        <span class="text-sm text-gray-200">Show</span>
                    </li>
                    <li>
                        <span class="text-white font-bold">
                            .
                        </span>
                    </li>
                    <li>
                        <span class="text-sm text-gray-200">{{ $show->title }}</span>
                    </li>
                </ul>
            </div>

            <div class="w-full grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 mt-10">
                <div class="relative">
                    <img src="{{ $show->getFirstMediaUrl('show_thumbnail') }}" alt="{{ $show->slug }}">
                    <div class="absolute inset-0 bg-slate-950 bg-opacity-40"></div>
                </div>
                <div class="lg:col-span-2">
                    <h2 class="text-gray-200 text-3xl md:text-5xl font-bold tracking-[2px]">{{ $show->title }}</h2>
                    <div class="mt-5">
                        <span class="flex items-center justify-center text-red-800 font-semibold rounded py-0.5 space-x-0.5 bg-yellow-600 w-[10%] text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                            </svg>
                            {{ count($show->episode) }}
                        </span>
                    </div>
                    <div class="my-3 md:my-5">
                        <p class="text-gray-200 font-light text-sm tracking-[1px] leading-6">{{ strip_tags($show->description) }}</p>
                    </div>
                    <div class="w-full">
                        <h3 class="text-2xl font-semibold text-gray-200">Info</h3>
                        <hr class="border-gray-50 my-2">
                        <ul class="grid grid-cols-2 mt-1">
                            <li class="block py-1">
                                <h3>
                                    <span class="text-gray-200 text-lg font-semibold">Host:</span>
                                    <span class="font-light text-gray-200 ml-1">{{ $show->user->name }}</span>
                                </h3>
                            </li>
                            <li class="block py-1">
                                <h3>
                                    <span class="text-gray-200 text-lg font-semibold">Primered On:</span>
                                    <span class="font-light text-gray-200 ml-1">{{ $show->created_at->toFormattedDateString() }}</span>
                                </h3>
                            </li>
                            <li class="block py-1">
                                <h3>
                                    <span class="text-gray-200 text-lg font-semibold">Duration:</span>
                                    <span class="font-light text-gray-200 ml-1">{{ $show->created_at->toFormattedDateString() }}</span>
                                </h3>
                            </li>
                            <li class="block py-1">
                                <h3>
                                    <span class="text-gray-200 text-lg font-semibold">Genres:</span>
                                    @foreach ($show->genre as $genre)
                                        <span class="ml-2 text-yellow-400">{{ $genre->name }}</span>
                                    @endforeach
                                </h3>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-10">
                        @if (count($show->episode))
                            <a href="{{ route('show.litsen', ['show' => $show->slug, 'ep' => $show->episode->first()->slug]) }}" class="bg-red-800 text-yellow-400 px-4 py-2 rounded-full">Litsen now</a>
                        @endif
                    </div>
                    <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layout.home')

@section('body')
    <section class="w-full py-10 bg-gray-800 drop-shadow">
        <div class="w-[95%] mx-auto" x-data="{ description: false }">
            <div>
                <ul class="flex items-center text-white space-x-3">
                    <li>
                        <a href="/" class="underline underline-offset-4 text-yellow-600 text-sm font-semibold">Home</a>
                    </li>
                    <li>
                        <span>
                            .
                        </span>
                    </li>
                    <li>
                        <a href="{{ route('show', $show->slug) }}" class="underline underline-offset-4 text-yellow-600 text-sm font-semibold">{{ $show->title }}</a>
                    </li>
                    <li>
                        <span>
                            .
                        </span>
                    </li>
                    <li>
                        <span class="text-gray-300 text-sm">{{ $selectedEpisode->title }}</span>
                    </li>
                </ul>
            </div>

            <div class="w-full lg:flex lg:space-x-7 mt-10">
                <div class="lg:w-[80%] grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-7">
                    @php
                        $count = 1;
                    @endphp
                    <div class="bg-slate-950 p-4 drop-shadow rounded grid grid-cols-5 gap-3">
                        @foreach ($show->episode->where('published', true) as $episode)
                            <a href="{{ route('show.litsen', ['show' => $show->slug, 'ep' => $episode->slug]) }}" class="bg-yellow-600 text-red-800 font-semibold text-xl flex items-center justify-center rounded drop-shadow">{{ $count++ }}</a>
                        @endforeach
                    </div>
                    <div class="rounded p-5 bg-slate-950 drop-shadow lg:col-span-2">
                        <div class="w-full">
                            <div class="">
                                <h3 class="text-gray-200 font-bold text-xl tracking-[2px] uppercase">{{ $selectedEpisode->title }}</h3>
                            </div>
                            <div class="mt-5">
                                <audio controls class="w-full bg-slate-950">
                                    <source src="{{ $selectedEpisode->getFirstMediaUrl('audio') }}" type="">
                                </audio>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-[20%] mt-7 lg:mt-0">
                    <div class="w-[30%]">
                        <img src="{{ $show->getFirstMediaUrl('show_thumbnail') }}" alt="{{ $show->slug }}" class="w-full rounded">
                    </div>
                </div>
            </div>

            <div class="mt-10">
                <a class="cursor-pointer mt-10 font-semibold text-yellow-600 text-sm flex items-center" @click="description = !description">
                    <span>Description</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>

                </a>
            </div>

            <div class="w-full mt-3" x-show="description" x-cloak x-transition @click="description = false">
                <div class="lg:w-[80%] bg-slate-950 p-7 rounded drop-shadow text-sm text-gray-300 lg:flex lg:items-start lg:space-x-7">
                    <div class="w-full lg:w-[20%]">
                        <img src="{{ $selectedEpisode->getFirstMediaUrl('episode_thumbnail') }}" class="rounded mx-auto w-[75%] lg:w-full">
                    </div>
                    <div class="w-full mt-5 lg:w-[80%] lg:mt-0">
                        {!! $selectedEpisode->description !!}

                        @if( $selectedEpisode->youtube_link || $selectedEpisode->spotify_link )
                        <div class="w-full mt-3">
                            <h3 class="font-semibold text-xl">Litsen to this episode on:</h3>

                            <ul class="flex items-center mt-1 space-x-3">
                                @if( $selectedEpisode->youtube_link )
                                <li>
                                    <a href="{{ $selectedEpisode->youtube_link }}" class="text-red-600 text-3xl" target="_blank">
                                        <i class="fa-brands fa-youtube"></i>
                                    </a>
                                </li>
                                @endif
                                @if( $selectedEpisode->spotify_link )
                                <li>
                                    <a href="{{ $selectedEpisode->spotify_link }}" class="text-green-600 text-3xl" target="_blank">
                                        <i class="fa-brands fa-spotify"></i>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-16">
        <div class="container px-5 md:px-3 lg:px-0">
            <div class="flex items-center bg-slate-800 drop-shadow-sm rounded p-3">
                <div class="w-[20%] lg:w-[5%]">
                    <img src="{{ asset('share-icon.gif') }}" alt="share" class="rounded-full">
                </div>
                <div class="ml-5">
                    <h3 class="text-yellow-400 text-xl font-semibold">Share Blvck</h3>
                    <p class="font-light text-white mt-0.5">To your friends</p>
                </div>
            </div>
        </div>
    </section>
    <section class="w-full my-16">
        <div class="container mx-auto px-5 md:px-3 lg:px-0">
            <div class="w-full">
                <div class="w-full lg:w-[60%] bg-slate-800 rounded drop-shadow p-7">
                    <h3 class="text-xl uppercase font-semibold text-gray-200">Ep: <span class="text-yellow-400">{{ $selectedEpisode->title }}</span></h3>
                    <div class="w-full mt-10">
                        @auth
                            <livewire:user.episode.comment :episode="$selectedEpisode" />
                        @else
                            <div class="w-full">
                                <p class="text-gray-200 text-start font-semibold">You need to <a href="{{ route('login') }}" class="text-yellow-600 underline underline-offset-4">login</a> to comment</p>
                            </div>
                        @endauth
                    </div>
                    <div class="w-full mt-7">
                        @if(!count($selectedEpisode->comments) > 0)
                            <div class="w-full">
                                <p class="text-gray-200 text-start font-semibold">No comments currently</p>
                            </div>
                        @else
                            <livewire:user.episode.comments :episode="$selectedEpisode" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

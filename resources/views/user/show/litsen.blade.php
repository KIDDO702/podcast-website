@extends('layout.home')

@section('body')
    <section class="w-full py-10 bg-gray-800 drop-shadow">
        <div class="w-[95%] mx-auto">
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


            <div class="w-full lg:flex lg:space-x-5 mt-10">
                <div class="lg:w-[80%] grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-7">
                    @php
                        $count = 1;
                    @endphp
                    <div class="bg-slate-950 p-4 drop-shadow rounded grid grid-cols-5 gap-3">
                        @foreach ($show->episode as $episode)
                            <a href="{{ route('show.litsen', ['show' => $show->slug, 'ep' => $episode->slug]) }}" class="bg-yellow-600 text-red-800 font-semibold text-xl flex items-center justify-center rounded drop-shadow">{{ $count++ }}</a>
                        @endforeach
                    </div>
                    <div class="rounded p-5 bg-slate-950 drop-shadow lg:col-span-2">
                        <div class="w-full">
                            <div class="">
                                <h3 class="text-gray-200 font-bold text-xl tracking-[2px] uppercase">{{ $selectedEpisode->title }}</h3>
                            </div>
                            <div class="my-5 rounded" id="aplayer"></div>
                            <div class="w-full p-3 rounded drop-shadow bg-gray-800">
                                <p class="text-gray-200 text-xs font-light leading-6">{{ strip_tags($selectedEpisode->description) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-[20%] mt-7 lg:mt-0">
                    <div class="w-full">
                        <img src="{{ $selectedEpisode->getFirstMediaUrl('episode_thumbnail') }}" alt="{{ $show->slug }}" class="w-[50%] mx-auto">
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
                    <div class="w-full">
                        @if(!count($selectedEpisode->comments) > 0)
                            <div class="w-full">
                                <p class="text-gray-200 text-center font-semibold">No comments currently</p>
                            </div>
                        @else
                            <livewire:user.episode.comments :comments="$selectedEpisode->comments" />
                        @endif
                    </div>
                    <div class="w-full mt-10">
                        @auth
                            <livewire:user.episode.comment :episode="$selectedEpisode" />
                        @else
                            <div class="w-full">
                                <p class="text-gray-200 text-start font-semibold">You need to <a href="{{ route('login') }}" class="text-yellow-600 underline underline-offset-4">login</a> to comment</p>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const ap = new APlayer({
            container: document.getElementById('aplayer'),
            preload: true,
            mini: false,
            // fixed: true,
            theme: '#1f2937',
            audio: [{
                name: '{{ $selectedEpisode->title }}',
                artist: '{{ $selectedEpisode->show->user->name }}',
                url: '{{ $selectedEpisode->getFirstMediaUrl('audio') }}',
                cover: '{{ $selectedEpisode->getFirstMediaUrl('episode_thumbnail') }}',
            }]
        });

    </script>
@endsection

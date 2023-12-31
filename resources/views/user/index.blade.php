@extends('layout.home')

@section('body')
    <header>
        <livewire:user.show-slider />
    </header>

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

    <section class="my-20">
        <div class="container px-5 md:px-3 lg:px-0">
            <div class="w-full bg-slate-700 border border-slate-600 p-7 rounded drop-shadow">
                <h3 class="text-yellow-400 text-2xl font-semibold">Latest Comments</h3>
                <livewire:user.latest-comments />
            </div>
        </div>
    </section>

    <section class="">
        <div class="container px-5 md:px-3 lg:px-0">
            <div class="w-full lg:flex lg:items-start lg:space-x-10 mt-5">
                <div class="w-full lg:w-[70%]">
                    <livewire:show-grid />
                </div>
                <div class="w-full lg:w-[30%] mt-10 lg:mt-0">
                    <livewire:genres />
                </div>
            </div>
        </div>
    </section>

    <section class="py-10">
        <div class="container px-5 md:px-3 lg:px-0">
            <div>
                <h3 class="text-yellow-400 text-3xl font-bold">Latest Episodes</h3>
            </div>

            <div class="mt-7 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 lg:gap-6">
                @foreach ($episodes as $episode)
                    @php
                        $show = $episode->show;
                    @endphp
                    <a href="{{ route('show.litsen', ['show' => $show->slug, 'ep' => $episode->slug]) }}" class="block">
                        <img
                            alt="{{ $episode->slug }}"
                            src="{{ $episode->getFirstMediaUrl('episode_thumbnail') }}"
                            class="h-64 w-full object-cover sm:h-80 lg:h-96"
                        />

                        <h3 class="mt-3 uppercase text-xl font-bold text-gray-400 sm:text-xl">{{ $episode->title }}</h3>
                        <span class="text-gray-500">{{ $episode->show->title }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    </section>
@endsection


@section('scripts')
    <script>
        new Splide( '.splide', {
            autoplay: true,
            rewind: true,
            rewindSpeed: 1000,
            speed: 500,
            pauseOnHover: false,
        } ).mount();
    </script>
@endsection

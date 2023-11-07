@extends('layout.home')

@section('body')
    <header>
        <livewire:user.show-slider />
    </header>

    <section class="mt-10 lg:mt-60">
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

    <section class="py-10">
        <div class="container">
            <h3 class="text-yellow-400 text-3xl font-bold">Latest Episodes</h3>
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        new Splide( '.splide', {
            autoplay: true
        } ).mount();
    </script>
@endsection

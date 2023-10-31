@extends('layout.host')


@section('body')
    <section class="w-full flex items-start space-x-10">
        <div class="container">
            <livewire:host.episode.show-episodes :shows="$userShows" />
        </div>
    </section>
@endsection

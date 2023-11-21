@extends('layout.home')

@section('body')
    <section class="w-full py-10 bg-gray-800 drop-shadow">
        <div class="w-[90%] mx-auto">
            <div>
                <ul class="flex items-center text-white space-x-3">
                    <li>
                        <a href="#" class="underline underline-offset-4 text-yellow-600">Home</a>
                    </li>
                    <li>
                        <span>
                            .
                        </span>
                    </li>
                    <li>
                        <span class="text-gray-300">{{ $show->title }}</span>
                    </li>
                    <li>
                        <span>
                            .
                        </span>
                    </li>
                </ul>
            </div>


            <div class="w-full flex items-start py-3">
                <div class="w-[80%] grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">
                    @php
                        $count = 1;
                    @endphp
                    <div class="bg-slate-950 px-5 py-3 drop-shadow rounded grid grid-cols-5 gap-2">
                        @foreach ($show->episode as $episode)
                            <a href="{{ route('show.litsen', ['show' => $show->slug, 'ep' => $episode->slug]) }}" class="bg-yellow-600 text-red-800 font-semibold text-xl flex items-center justify-center rounded drop-shadow">{{ $count++ }}</a>
                        @endforeach
                    </div>
                    <div class="rounded lg:col-span-2">

                    </div>
                </div>
                <div class="w-[20%]"></div>
            </div>
        </div>
    </section>
@endsection

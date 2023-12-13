@extends('layout.host')

@section('body')
	<section class="my-10">
        <div class="container px-5 md:px-3 lg:px-0">
            <div class="">
                <h3 class="font-extrabold text-4xl text-yellow-600">Dashboard</h3>
                <h6 class="text-gray-400 text-lg mt-1">Welcome <span class="text-yellow-600">{{ auth()->user()->name }}</span></h6>
            </div>
            <hr class="my-7 border-yellow-600">
            <div class="w-full grid md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-slate-700 p-7 rounded border border-slate-600 drop-shadow">
                    <div class="w-full flex justify-center items-center">
                        <a href="{{ route('host.genre') }}" class="inline-flex items-center justify-center p-3 rounded-md bg-opacity-80 bg-yellow-50 text-yellow-950 border border-yellow-300">
                            <span class="material-symbols-outlined text-3xl">
                            	category
                        	</span>
                        </a>
                    </div>
                    <div class="mt-5 w-full flex items-center justify-center">
                        <div class="mx-auto text-gray-300">
                            <h3 class="text-3xl font-semibold">My Genres</h3>
                            <span class="w-full flex items-center font-semibold">{{ str_pad($genres, 3, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-700 p-7 rounded border border-slate-600 drop-shadow">
                    <div class="w-full flex justify-center items-center">
                        <a href="{{ route('host.show') }}" class="inline-flex items-center justify-center p-3 rounded-md bg-opacity-80 bg-red-50 text-red-950 border border-red-300">
                            <span class="material-symbols-outlined text-3xl">
                            	featured_play_list
                        	</span>
                        </a>
                    </div>
                    <div class="mt-5 w-full flex items-center justify-center">
                        <div class="mx-auto text-gray-300">
                            <h3 class="text-3xl font-semibold">My Shows</h3>
                            <span class="w-full flex items-center font-semibold">{{ str_pad($shows, 3, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-700 p-7 rounded border border-slate-600 drop-shadow">
                    <div class="w-full flex justify-center items-center">
                        <a href="{{ route('host.episode') }}" class="inline-flex items-center justify-center p-3 rounded-md bg-opacity-80 bg-green-50 text-green-950 border border-green-300">
                            <span class="material-symbols-outlined text-3xl">
                            	music_video
                        	</span>
                        </a>
                    </div>
                    <div class="mt-5 w-full flex items-center justify-center">
                        <div class="mx-auto text-gray-300">
                            <h3 class="text-3xl font-semibold">My Episodes</h3>
                            <span class="w-full flex items-center font-semibold">{{ str_pad($episodes, 3, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-700 p-7 rounded border border-slate-600 drop-shadow">
                    <div class="w-full flex justify-center items-center">
                        <a href="{{ route('host.trash') }}" class="inline-flex items-center justify-center p-3 rounded-md bg-opacity-80 bg-red-50 text-red-950 border border-red-300">
                            <span class="material-symbols-outlined text-3xl">
                            	recycling
                        	</span>
                        </a>
                    </div>
                    <div class="mt-5 w-full flex items-center justify-center">
                        <div class="mx-auto text-gray-300">
                            <h3 class="text-3xl font-semibold">Trash</h3>
                            <span class="w-full flex items-center font-semibold">{{ str_pad($trash, 3, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-10">
        <div class="container px-5 md:px-3 lg:px-0">
            <div class="grid lg:grid-cols-2 gap-4">
                <div class="bg-slate-700 p-5 rounded drop-shadow border border-slate-600">
                    <h3 class="text-2xl font-semibold text-gray-300">Latest Episodes</h3>
                    <div class="mt-3 w-full overflow-x-auto">
                        <livewire:host.latest-episodes />
                    </div>
                </div>
                <div class="bg-slate-700 p-5 rounded drop-shadow border border-slate-600">
                    <h3 class="text-2xl font-semibold text-gray-300">Latest Comments</h3>
                    <div class="mt-3 w-full overflow-x-auto">
                        <livewire:host.latest-comments />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

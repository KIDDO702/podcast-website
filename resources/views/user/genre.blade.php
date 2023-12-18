@extends('layout.home')

@section('body')
    <section class="py-10">
        <div class="container px-5 md:px-3 lg:px-0">
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
                        <span class="text-gray-300 text-sm">{{ $genre->name }}</span>
                    </li>
                </ul>
            </div>

            <div class="w-full mt-7 grid grid-cols-2 md:grid-cols-4 gap-5">
            @foreach ($shows as $show)
                <a href="{{ route('show', $show->slug) }}" class="group relative rounded overflow-hidden block bg-black">
                    <img
                        alt="{{ $show->slug }}"
                        src="{{ $show->getFirstMediaUrl('show_thumbnail') }}"
                        class="absolute rounded inset-0 h-full w-full object-cover opacity-75 transition-all group-hover:opacity-50 group-hover:scale-110"
                    />

                    <div class="relative p-4 sm:p-6 lg:p-8">
                        <p class="text-lg p-1 text-center font-semibold bg-red-800 uppercase tracking-widest rounded text-yellow-400">
                            {{ $show->title }}
                        </p>

                        <div class="mt-32 sm:mt-48 lg:mt-64">
                            <div
                                class="translate-y-8 transform opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100"
                            >
                                <p class="text-sm text-white">
                                {{ Str::limit(strip_tags($show->description), 200, '...') }}
                                </p>

                                <p class="text-sm mt-2 font-bold text-yellow-400">{{ $show->user->name }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            </div>
        </div>
    </section>
@endsection

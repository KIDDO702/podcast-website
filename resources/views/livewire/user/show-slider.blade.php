<div class="text-gray-300">
    <div class="splide">
        <div class="splide__track">
            <div class="splide__list">
                @foreach ($shows as $show)
                    <div class="splide__slide flex w-full" data-splide-interval="10000">
                        <div class="hidden w-[50%] h-full px-7 lg:flex lg:items-center">
                            <div class="w-full">
                                <h3 class="text-5xl uppercase font-bold tracking-[3px]">{{ $show->title }}</h3>

                                <div class="mt-7 flex items-center space-x-5">
                                    <span class="flex items-center justify-center space-x-2 bg-red-800 py-0.5 w-[6%] text-yellow-300 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                                        </svg>

                                        {{ count($show->episode) }}
                                    </span>

                                    <span class="text-gray-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                        </svg>

                                        <small class="mr-2 text-lg">{{ $show->created_at->toFormattedDateString() }}</small>
                                    </span>

                                    <span class="text-gray-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                        </svg>

                                        <small class="mr-2 text-lg">{{ $show->user->name }}</small>
                                    </span>
                                </div>

                                <p class="mt-7 leading-6 text-sm tracking-[2px] font-light">{{  Str::limit(strip_tags($show->description), 300, '...')  }}</p>

                                <div class="mt-7 flex items-center space-x-7">
                                    <a href="#" class="flex items-center justify-center px-3 py-2 rounded-full bg-yellow-600 text-red-900 w-[20%] transition-all hover:drop-shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                                        </svg>

                                        <span class="text-xl ml-1 font-semibold">
                                            Listen
                                        </span>
                                    </a>
                                    <a href="{{ route('show', $show->slug) }}" class="flex items-center justify-center px-3 py-2 rounded-full bg-slate-700 text-gray-100 w-[20%] transition-all hover:drop-shadow-md text-xl">
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-[50%]">
                            <div class="w-full flex justify-end relative">
                                <img src="{{ $show->getFirstMediaUrl('show_thumbnail') }}" alt="{{ $show->slug }}" class="w-full lg:w-[90%]">

                                <div class="lg:hidden absolute inset-0 bg-slate-900 bg-opacity-50 flex items-end">
                                    <div class="w-full bg-slate-900 bg-opacity-70 text-white text-end pr-3">
                                        <h3 class="uppercase font-semibold py-0.5 text-xl">{{ $show->title }}</h3>
                                        <small>{{ $show->user->name }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

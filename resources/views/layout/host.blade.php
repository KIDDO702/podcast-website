<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blvck Host</title>

    {{-- google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;0,6..12,1000;1,6..12,200;1,6..12,300;1,6..12,400;1,6..12,500;1,6..12,600;1,6..12,700;1,6..12,800;1,6..12,900;1,6..12,1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">

    <x-host.tinymce-config/>

    <link rel="stylesheet" href="{{ asset('build/assets/app-cc57fb09.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-f09d4a24.css') }}" />

    @livewireStyles()
</head>
<body class="antialised bg-slate-950 font-nunito">
    <livewire:toasts />

    <div class="bg-red-800 text-center py-0.5">
        <p class="text-lg text-yellow-400 uppercase"><span class="font-bold">Note:</span> This is a demo web app</p>
    </div>
    <nav class="bg-yellow-600 sticky top-0 z-30">
        <div class="container mx-auto">
            <div class="py-1 mx-auto flex items-center justify-between w-[90%]">
                <a href="" class="w-[10%] lg:w-[7%]">
                    <img src="{{ asset('logo.png') }}" alt="logo" class="">
                </a>


                <ul class="hidden lg:flex lg:items-center lg:justify-center lg:space-x-10">
                    <li>
                        <a href="{{ route('host.index') }}" class="text-xl font-semibold hover:text-red-800">Dashboard</a>
                    </li>
                    @can('create genre')
                    <li>
                        <a href="{{ route('host.genre') }}" class="text-xl font-semibold hover:text-red-800">Genres</a>
                    </li>
                    @endcan
                    <li>
                        <a href="{{ route('host.show') }}" class="text-xl font-semibold hover:text-red-800">Shows</a>
                    </li>
                    <li>
                        <a href="{{ route('host.episode') }}" class="text-xl font-semibold hover:text-red-800">Episodes</a>
                    </li>
                    <li>
                        <a href="{{ route('host.trash') }}" class="text-xl font-semibold hover:text-red-800">Trash</a>
                    </li>
                </ul>

                <div class="flex items-center space-x-5">
                    @auth
                        <div class="relative w-full flex justify-center" x-data="{ profile: false }">
                            <a class="cursor-pointer text-xl font-semibold flex justify-center" @click="profile = !profile">
                                <span class="bg-red-800 text-white px-4 py-2 rounded drop-shadow-sm uppercase transition-all hover:drop-shadow-lg">{{ auth()->user()->username }}</span>
                            </a>

                            <div class="absolute top-0 z-20 mt-[60px] w-[190px] bg-yellow-600 flex justify-center rounded-b" x-show="profile" x-transition:enter-start="translate-x-full" x-transition:enter-end="-translate-x-0" x-transition:leave="transition ease-in duration-300 trasnform" x-transition:leave-start="-translate-x-0" x-transition:leave-end="translate-x-full" @click.outside="profile = false" x-cloak>
                                <ul class="w-full divide-y divide-red-800">
                                    <li class="block py-1.5 px-2.5">
                                        <a href="/" class="text-lg font-semibold flex items-center">
                                            <span class="material-symbols-outlined mr-2 text-red-800 text-3xl">
                                                home
                                            </span>
                                            <span>Home</span>
                                        </a>
                                    </li>
                                    @role('host')
                                    <li class="block py-1.5 px-2.5">
                                        <a href="{{ route('host.index') }}" class="text-lg font-semibold flex items-center">
                                            <span class="material-symbols-outlined mr-2 text-red-800 text-3xl">
                                                supervised_user_circle
                                            </span>
                                            <span>
                                                Host
                                            </span>
                                        </a>
                                    </li>
                                    @endrole
                                    @role('admin')
                                    <li class="block py-1.5 px-2.5">
                                        <a href="{{ route('admin.index') }}" class="text-lg font-semibold flex items-center">
                                            <span class="material-symbols-outlined mr-2 text-red-800 text-3xl">
                                                shield_person
                                            </span>
                                            <span>
                                                Admin
                                            </span>
                                        </a>
                                    </li>
                                    @endrole
                                    <li class="block py-1.5 px-2.5 bg-red-800 text-yellow-500">
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="text-lg font-semibold flex items-center">
                                                <span class="material-symbols-outlined mr-2 text-yellow-500 text-3xl">
                                                    logout
                                                </span>
                                                <span>Logout</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-lg font-semibold flex items-center bg-red-800 text-white px-4 py-2.5 rounded drop-shadow-sm
                            hover:drop-shadow-md">
                            <span class="material-symbols-outlined mr-2">
                                person_add
                            </span>
                            <span>
                                Log In
                            </span>
                        </a>
                    @endauth
                    <div class="lg:hidden">
                        <button class="border-2 border-red-800 px-3 py-2.5 rounded text-red-800 font-semibold">
                            menu
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>

        @yield('body')

    </main>

    <hr class="border-gray-100 my-7">
    <footer>
        <div class="text-center pb-5">
            <p class="text-center font-semibold text-gray-600 text-lg uppercase">Copywright &copy; 2023 Blvck Media. All Rights Reserved</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
    <script src="{{ asset('build/assets/app-d32546a1.js') }}"></script>
    @yield('scripts')

    @livewireScriptConfig()
</body>
</html>

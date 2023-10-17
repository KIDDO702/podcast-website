<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blvck Radio</title>

    {{-- Google fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialised bg-slate-950">
    <livewire:toasts />
    <nav class="bg-yellow-600">
        <div class="container mx-auto">
            <div class="py-1 mx-auto flex items-center justify-between w-[90%]">
                <a href="" class="w-[7%]">
                    <img src="{{ asset('logo.png') }}" alt="logo" class="">
                </a>


                <ul class="flex items-center justify-center space-x-10">
                    <li>
                        <a href="" class="text-xl font-semibold hover:text-red-800">Home</a>
                    </li>
                    <li>
                        <a href="" class="text-xl font-semibold hover:text-red-800">Shows</a>
                    </li>
                    <li>
                        <a href="" class="text-xl font-semibold hover:text-red-800">Articles</a>
                    </li>
                    <li>
                        <a href="" class="text-xl font-semibold hover:text-red-800">Hosts</a>
                    </li>
                </ul>

                <div>
                    @auth
                        <div class="relative w-full flex justify-center" x-data="{ profile: false }">
                            <a class="cursor-pointer text-xl font-semibold flex justify-center" @click="profile = !profile">
                                <span class="bg-red-800 text-white px-4 py-2 rounded drop-shadow-sm uppercase transition-all hover:drop-shadow-lg">{{ auth()->user()->username }}</span>
                            </a>

                            <div class="absolute top-0 mt-[60px] w-[190px] bg-yellow-600 flex justify-center rounded-b" x-show="profile" x-transition:enter-start="translate-x-full" x-transition:enter-end="-translate-x-0" x-transition:leave="transition ease-in duration-300 trasnform" x-transition:leave-start="-translate-x-0" x-transition:leave-end="translate-x-full" @click.outside="profile = false" x-cloak>
                                <ul class="w-full divide-y divide-red-800">
                                    <li class="block py-1.5 px-2.5">
                                        <a href="#" class="text-lg font-semibold flex items-center">
                                            <span class="material-symbols-outlined mr-2 text-red-800 text-3xl">
                                                account_circle
                                            </span>
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    @role('host')
                                    <li class="block py-1.5 px-2.5">
                                        <a href="#" class="text-lg font-semibold flex items-center">
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
                                        <a href="#" class="text-lg font-semibold flex items-center">
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
                </div>
            </div>
        </div>
    </nav>
    <main>
        @yield('body')
    </main>

    @livewireScriptConfig
</body>
</html>

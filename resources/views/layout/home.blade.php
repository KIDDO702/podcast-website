<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blvck Radio</title>

    {{-- Google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;0,6..12,1000;1,6..12,200;1,6..12,300;1,6..12,400;1,6..12,500;1,6..12,600;1,6..12,700;1,6..12,800;1,6..12,900;1,6..12,1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/aplayer/1.10.1/APlayer.min.css"              integrity="sha512-CIYsJUa3pr1eoXlZFroEI0mq0UIMUqNouNinjpCkSWo3Bx5NRlQ0OuC6DtEB/bDqUWnzXc1gs2X/g52l36N5iw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialised bg-slate-950 font-poppins overflow-x-hidden">
    <livewire:toasts />


    <nav class="sticky top-0 z-30 drop-shadow">
        <div class="bg-red-800 text-center py-0.5">
            <p class="text-lg text-yellow-400 uppercase"><span class="font-bold">Note:</span> This is a demo web app</p>
        </div>
        <div class="bg-yellow-600">
            <div class="container mx-auto">
                <div class="py-1 mx-auto flex items-center justify-between px-3">
                    <div class="lg:w-[30%]">
                        <a href="/" class="w-full">
                            <img src="{{ asset('logo.png') }}" alt="logo" class="w-[25%] lg:w-[17%]">
                        </a>
                    </div>


                    {{-- <div class="">
                        <ul class="w-full flex items-center justify-center space-x-10">
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
                    </div> --}}

                    <div class="lg:w-[20%]">
                        @auth
                            <div class="relative w-full flex justify-end" x-data="{ profile: false }">
                                <a class="cursor-pointer text-xl font-semibold w-full flex justify-end" @click="profile = !profile">
                                    {{-- <span class="bg-red-800 text-white px-4 py-2 rounded drop-shadow-sm uppercase transition-all hover:drop-shadow-lg">{{ auth()->user()->username }}</span> --}}
                                    @if (!auth()->user()->hasMedia('avatar'))
                                        <img src="{{ asset('avatar.png') }}" alt="{{ auth()->user()->username }}" class="w-[25%] lg:w-[17%] bg-slate-700 rounded-full outline outline-red-800 outline-offset-2">
                                    @endif
                                </a>

                                <div class="absolute top-0 right-0 mt-[60px] w-[200px] bg-yellow-600 flex justify-center rounded-b" x-show="profile" x-transition:enter-start="translate-y-full" x-transition:enter-end="-translate-y-0" x-transition:leave="transition ease-in duration-300 trasnform" x-transition:leave-start="-translate-y-0" x-transition:leave-end="translate-y-full" @click.outside="profile = false" x-cloak>
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
                            <a href="{{ route('login') }}" class="text-lg font-semibold flex items-center justify-center bg-red-800 text-white px-4 py-2.5 rounded drop-shadow-sm
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
        </div>
    </nav>

    <main>
        @yield('body')
    </main>

    {{-- splider-js --}}
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aplayer/1.10.1/APlayer.min.js"
        integrity="sha512-RWosNnDNw8FxHibJqdFRySIswOUgYhFxnmYO3fp+BgCU7gfo4z0oS7mYFBvaa8qu+axY39BmQOrhW3Tp70XbaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('scripts')
    @livewireScriptConfig
</body>
</html>

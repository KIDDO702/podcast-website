<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blvck Admin</title>

    {{-- google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;0,6..12,1000;1,6..12,200;1,6..12,300;1,6..12,400;1,6..12,500;1,6..12,600;1,6..12,700;1,6..12,800;1,6..12,900;1,6..12,1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">

    <x-head.tinymce-config/>

    {{-- filepond --}}
    {{-- <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet"/> --}}


    {{-- filepond-plugins
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script> --}}


     {{-- filepond --}}
    {{-- <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script> --}}

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 flex font-poppins">
    <livewire:toasts />
    <div class="hidden md:w-[20%] lg:w-[18%] h-screen md:block fixed bg-slate-900">
        <div class="w-full h-full">

            <ul class="text-white mt-10 px-4 h-full relative">
                <li>
                    <small class="text-gray-200">Home</small>
                </li>
                <li class="mt-1">
                    <a href="{{ route('admin.index') }}" class="flex items-center space-x-2">
                        <span class="material-symbols-outlined">
                            team_dashboard
                        </span>
                        <span class="font-semibold text-lg">
                            Dashboard
                        </span>
                    </a>
                </li>

                @can('manage podcast')
                <li class="mt-7">
                    <small class="text-gray-200">Podcast</small>
                </li>
                <li class="block py-1.5">
                    <a href="{{ route('admin.genre') }}" class="flex items-center space-x-2">
                        <span class="material-symbols-outlined">
                            category
                        </span>
                        <span class="font-semibold text-lg">Genres</span>
                    </a>
                </li>
                <li class="block py-1.5">
                    <a href="{{ route('admin.show') }}" class="flex items-center space-x-2">
                        <span class="material-symbols-outlined">
                            featured_play_list
                        </span>
                        <span class="font-semibold text-lg">
                            Shows
                        </span>
                    </a>
                </li>
                @endcan
                <li class="block py-1.5">
                    <a href="{{ route('admin.episode') }}" class="flex items-center space-x-2">
                        <span class="material-symbols-outlined">
                            music_video
                        </span>
                        <span class="font-semibold text-lg">
                            Episodes
                        </span>
                    </a>
                </li>

                <li class="mt-7">
                    <small class="text-gray-200">Roles & Permissions</small>
                </li>
                <li class="block py-1.5">
                    <a href="{{ route('admin.role') }}" class="flex items-center space-x-2">
                        <span class="material-symbols-outlined">
                            lock_person
                        </span>
                        <span class="font-semibold text-lg">
                            Roles
                        </span>
                    </a>
                </li>
                @can('manage permission')
                <li class="block py-1.5">
                    <a href="{{ route('admin.permission') }}" class="flex items-center space-x-2">
                        <span class="material-symbols-outlined">
                            key
                        </span>
                        <span class="font-semibold text-lg">
                            Permissions
                        </span>
                    </a>
                </li>
                @endcan

                <li class="mt-7">
                    <small class="text-gray-200">Users</small>
                </li>
                <li class="block py-1.5">
                    <a href="{{ route('admin.user') }}" class="flex items-center space-x-2">
                        <span class="material-symbols-outlined">
                            group
                        </span>
                        <span class="font-semibold text-lg">
                            Users
                        </span>
                    </a>
                </li>


                <li class="block py-1.5 absolute bottom-14">
                    <a href="{{ route('admin.trash') }}" class="flex items-center space-x-2">
                        <span class="material-symbols-outlined">
                            recycling
                        </span>
                        <span class="font-semibold text-lg">
                            Trash
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="md:ml-[20%] lg:ml-[18%] w-full">
        <nav class="bg-white w-[100%]  drop-shadow sticky top-0 z-20">
            <div class="w-[90%] mx-auto py-2 flex items-center justify-between">
                <form action="#" class="flex items-center w-[30%]">
                    <div class="w-full flex items-center">
                        <input type="text" placeholder="Search Here" class="bg-gray-50 border py-1.5 px-4 w-full border-gray-100 rounded-l-full focus:outline-none placeholder:text-sm">
                        <button type="submit" class="bg-slate-900 py-1.5 px-2 text-white flex items-center justify-center rounded-r-full border border-slate-900">
                            <span class="material-symbols-outlined">
                                search
                            </span>
                        </button>
                    </div>
                </form>

                <ul class="">
                    <li class="relative w-[150px] flex justify-center" x-data="{ dropdown: false }">
                        <a class="cursor-pointer" @click="dropdown = !dropdown">
                            <span class="font-semibold">{{ auth()->user()->username }}</span>
                        </a>


                        <ul class="absolute divide-y divide-slate-100 bg-white border border-slate-100 mt-[39px] w-[150px]" x-show="dropdown" x-cloak @click.outside="dropdown = false">
                            <li class="block py-1.5 px-4">
                                <a href="{{ route('home') }}">
                                    Home
                                </a>
                            </li>
                            <li class="block py-1.5 px-4">
                                <a href="#">Profile</a>
                            </li>
                            @role('host')
                            <li class="block py-1.5 px-4">
                                <a href="{{ route('host.index') }}">Host</a>
                            </li>
                            @endrole
                            <li class="block py-1.5 px-4">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="p-10">
            @yield('body')
        </div>

        <div class="px-5">
            <hr class="border-slate-300 mb-5">

            <div class="text-center pb-5">
                <p class="text-center font-semibold text-gray-600 text-lg uppercase">Copywright &copy; 2023 Blvck Media. All Rights Reserved</p>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
    @yield('scripts')
    @livewireScriptConfig
</body>
</html>

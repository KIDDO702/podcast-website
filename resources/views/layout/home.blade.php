<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blvck Radio</title>

    {{-- Google fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    @vite('resources/css/app.css')
</head>
<body class="antialised bg-slate-950">
    <nav class="bg-yellow-600">
        <div class="container mx-auto">
            <div class="py-1 flex items-center justify-between">
                <a href="" class="w-[8%]">
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
                    <a href="" class="text-lg font-semibold flex items-center bg-red-800 text-white px-4 py-2.5 rounded drop-shadow-sm
                    hover:drop-shadow-md">
                        <span class="material-symbols-outlined mr-2">
                            person_add
                        </span>
                        <span>
                            Log In
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <main>
        @yield('body')
    </main>
</body>
</html>

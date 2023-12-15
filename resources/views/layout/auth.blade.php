<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blvck Podcast</title>

    {{-- Google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;0,6..12,1000;1,6..12,200;1,6..12,300;1,6..12,400;1,6..12,500;1,6..12,600;1,6..12,700;1,6..12,800;1,6..12,900;1,6..12,1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    @livewireStyles
    <link rel="stylesheet" href="{{ asset('build/assets/app-23d0f508.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/assets/app-cc57fb09.css') }}" />


</head>
<body class="antialiased bg-slate-950 font-nunito">
    <livewire:toasts />
    <section class="w-full h-screen px-5 flex items-center justify-center lg:px-0">
        <div class="bg-slate-200 drop-shadow-md rounded py-4 lg:w-[28%]">
            <div class="w-full">
                <img src="{{ asset('logo.png') }}" alt="logo" class="w-[45%] mx-auto">
            </div>

            <div class="mt-8 px-4">
                @yield('form')
            </div>
        </div>
    </section>

    <script src="{{ asset('build/assets/app-4915183b.js') }}"></script>
    @livewireScriptConfig
</body>
</html>

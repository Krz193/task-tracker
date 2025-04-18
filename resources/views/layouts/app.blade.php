<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @php
            $types = ['success', 'error', 'warning', 'info'];
        @endphp

        <div class="alert-container flex w-full top-3 space-y-3 items-center absolute flex-col z-50">
        @foreach ($types as $type)
            @if (session($type))
                <x-alert :type="$type" :message="session($type)" />
            @endif
        @endforeach

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert type="error" :message="$error" />
            @endforeach
        @endif
        </div>


        <div class="min-h-screen bg-gray-100">
            {{-- @include('layouts.navigation') --}}

            <!-- Page Content -->
            <main class="container flex flex-row w-full h-screen">
                <!-- Sidebar (selalu tampil di semua halaman) -->
                <x-sidebar :projects="$projects" class="p-5 bg-white shadow sticky left-0 top-0" />

                <div class="flex-1 py-5 px-8 overflow-y-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>

        {{-- JS Flowbite --}}
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>

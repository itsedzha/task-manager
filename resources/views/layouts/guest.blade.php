<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .background-image {
                background-image: url('{{ asset("imagees/background.png") }}');
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            <div class="w-1/2 background-image relative flex items-center justify-center">
                <div class="absolute inset-0 bg-black opacity-30"></div>
                <div class="relative z-10 text-center text-white">
                    <h1 class="text-4xl font-bold">Welcome to Task Manager</h1>
                    <p class="mt-4 text-lg">Organize your tasks efficiently</p>
                </div>
            </div>

            <!-- laba kolumna -->
            <div class="w-1/2 flex items-center justify-center bg-gray-900">
                <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 shadow-md rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>

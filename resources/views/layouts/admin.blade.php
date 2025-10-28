<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/b3054ece34.js" crossorigin="anonymous"></script>

    <wireui:scripts />

    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">

@include('layouts.includes.admin.navigation')

@include('layouts.includes.admin.sidebar')

<div class="p-4 sm:ml-64">
    <div class="mt-14">
        {{$slot}}
    </div>
</div>

@stack('modals')

@livewireScripts
<script src="https://kit.fontawesome.com/b3054ece34.js" crossorigin="anonymous"></script>
</body>
</html>

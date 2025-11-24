@props([
    'title' =>  config('app.name', 'Laravel'),
    'breadcrumbs' => []])

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title  }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Script para el sweetalert 2 o ventana de notificación --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <wireui:scripts />

    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">

@include('layouts.includes.admin.navigation')

@include('layouts.includes.admin.sidebar')

<div class="px-4 pb-4 sm:ml-64 pt-6">

    <div class="flex justify-between items-center mb-4 mt-2">

        @if (count($breadcrumbs))
            <nav class="flex">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 rtl:space-x-reverse">

                    @foreach ($breadcrumbs as $breadcrumb)
                        <li class="inline-flex items-center">
                            {{-- Si no es el último item, es un enlace --}}

                            @if (!$loop->last && isset($breadcrumb['href']))

                                <a href="{{ $breadcrumb['href'] }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    {{ $breadcrumb['name'] }}
                                </a>
                                <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                {{-- Si es el último item, es solo texto --}}
                            @else
                                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                        {{ $breadcrumb['name'] }}
                                    </span>
                            @endif
                        </li>
                    @endforeach

                </ol>
            </nav>
        @endif

        @if (isset($action))
            <div class="mt-4">
                {{ $action }}
            </div>
        @endif

    </div>

    {{$slot}}

</div>

@stack('modals')

@livewireScripts
{{-- Esta es la única copia del script que necesitas --}}
<script src="https://kit.fontawesome.com/b3054ece34.js" crossorigin="anonymous"></script>

{{-- Mostrar Sweet Alert --}}
@if (@session('swal'))
    <script>
        Swal.fire({!! json_encode(session('swal')) !!});
    </script>
@endif

</body>
</html>

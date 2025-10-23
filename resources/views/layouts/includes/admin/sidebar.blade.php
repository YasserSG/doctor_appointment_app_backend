@php
    // Arreglo de íconos para el menú dinámico
    // CAMBIO 1: El arreglo se llama $links (plural)
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge', // Icono de Font Awesome
            // CAMBIO 2: La ruta es 'dashboard', no 'admin.dashboard'
            'href' => route('dashboard'),
           'active' => request()->routeIs('dashboard'),
        ],
        [
            'name' => 'Agendar Cita',
            'icon' => 'fa-solid fa-calendar-plus', // Icono de Font Awesome
            'href' => '#', // Cambia '#' por tu ruta de agendar
           'active' => false, // Cambia esto si tienes una ruta
        ],
    ];
@endphp

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-cyan-800 dark:border-cyan-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-cyan-800">
        <ul class="space-y-2 font-medium">

            {{-- INICIO: BUCLE DINÁMICO (DEL VIDEO) --}}

            {{-- CAMBIO 3: El bucle es "@foreach ($links as $link)" --}}
            @foreach ($links as $link)
                <li>
                    {{-- CAMBIO 4: Se aplica la clase 'active' y se corrige el hover --}}
                    <a href="{{ $link['href'] }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-cyan-700 group {{ $link['active'] ? 'bg-gray-100 dark:bg-cyan-700' : '' }}">

                        {{-- Contenedor para el ícono de Font Awesome --}}
                        <span class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true">
                        <i class="{{ $link['icon'] }}"></i>
                    </span>

                        {{-- CAMBIO 5: Se quitan las comillas extra de {{ $link['name'] }} --}}
                        <span class="ms-3">{{ $link['name'] }}</span>
                    </a>
                </li>
            @endforeach
            {{-- FIN: BUCLE DINÁMICO --}}


            {{-- =================================================== --}}
            {{-- INICIO: Menú Multinivel (Entregable ADA 1) --}}
            {{-- =================================================== --}}
            <li>
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-cyan-700" aria-controls="dropdown-gestion" data-collapse-toggle="dropdown-gestion">

                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-2a6.957 6.957 0 0 1 1.264-3H1a1 1 0 0 1 0-2h1.264A6.957 6.957 0 0 1 1 6V4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2a6.957 6.957 0 0 1-1.264 3H15a1 1 0 0 1 0 2Z"/>
                    </svg>

                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Gestión</span>

                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>

                <ul id="dropdown-gestion" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg ps-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-cyan-700">Doctores</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg ps-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-cyan-700">Pacientes</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg ps-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-cyan-700">Especialidades</a>
                    </li>
                </ul>
            </li>
            {{-- =================================================== --}}
            {{-- FIN: Menú Multinivel --}}
            {{-- =================================================== --}}

        </ul>
    </div>
</aside>

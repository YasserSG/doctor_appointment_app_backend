<x-layouts.admin title="Usuarios | Healthify" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
    ],
]">
    <x-slot name="action">

        <a href="{{ route('admin.users.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <i class="fa-solid fa-plus mr-2"></i>
            Nuevo Usuario
        </a>

    </x-slot>

    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Gestión de Usuarios</h2>
        <p class="text-gray-700 dark:text-gray-400">Aquí se mostrará la tabla de usuarios (Rappasoft/Livewire).</p>
    </div>

</x-layouts.admin>

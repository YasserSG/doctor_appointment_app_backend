<x-layouts.admin title="Roles | Healthify" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',

    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.roles.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <i class="fa-solid fa-plus mr-2"></i>
            Nuevo
        </a>
    </x-slot>
    @livewire('admin.datatable.role_table')

</x-layouts.admin>

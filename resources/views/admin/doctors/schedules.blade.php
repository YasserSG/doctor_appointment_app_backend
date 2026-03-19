<x-admin-layout
    title="Horarios del Doctor | Admin"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Doctores',
            'href' => route('admin.doctors.index'),
        ],
        [
            'name' => 'Horarios',
        ],
    ]">

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 max-w-4xl mx-auto">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Horarios en construcción</h2>
        <p class="text-gray-600">Este módulo aún no ha sido implementado, pero el botón funciona de manera correcta como solicitan las especificaciones.</p>
        
        <div class="mt-6">
            <x-wire-button secondary href="{{ route('admin.doctors.index') }}">
                Volver
            </x-wire-button>
        </div>
    </div>
</x-admin-layout>

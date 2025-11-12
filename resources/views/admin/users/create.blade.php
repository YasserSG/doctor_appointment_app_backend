<x-layouts.admin title="Nuevo Usuario" :breadcrumbs="[
    [ 'name' => 'Dashboard', 'href' => route('admin.dashboard') ],
    [ 'name' => 'Usuarios', 'href' => route('admin.users.index') ],
    [ 'name' => 'Nuevo' ]
]">
    <x-card>
        <h2 class="text-xl font-semibold mb-4">Crear Nuevo Usuario</h2>
        <p>Aquí irá el formulario de creación.</p>
    </x-card>
</x-layouts.admin>

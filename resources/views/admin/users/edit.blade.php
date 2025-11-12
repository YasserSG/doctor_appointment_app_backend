<x-layouts.admin title="Editar Usuario" :breadcrumbs="[
    [ 'name' => 'Dashboard', 'href' => route('admin.dashboard') ],
    [ 'name' => 'Usuarios', 'href' => route('admin.users.index') ],
    [ 'name' => 'Editar' ]
]">
    <x-card>
        <h2 class="text-xl font-semibold mb-4">Editar Usuario</h2>
        <p>Aquí irá el formulario de edición.</p>
    </x-card>
</x-layouts.admin>

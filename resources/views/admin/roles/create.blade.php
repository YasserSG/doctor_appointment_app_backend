<x-layouts.admin title="Crear Rol | Healthify" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
        'href' => route('admin.roles.index'),
    ],
    [
        'name' => 'Nuevo',
    ]
]">

    <x-wire-card>
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <x-wire-imput label="Nombre" name="name" placeholder="Nombre">
            </x-wire-imput>
            <div class="flex justify-end mt-4">
                <x-wire-button type="submit" blue>Guardar</x-wire-button>
            </div>
        </form>
    </x-wire-card>

</x-layouts.admin>

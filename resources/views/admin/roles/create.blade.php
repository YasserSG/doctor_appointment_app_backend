<x-layouts.admin title="Roles | Healthify" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
        'href' => route('admin.roles.index'),
    ],
]">

    <x-card>
        <form action="{{ route('admin.roles.store') }}" method="POST"
        >
            @csrf

            <x-input label="Nombre" name="name" placeholder="Nombre del rol"  value="{{ old('name') }}"></x-input>

            <div class="flex justify-end mt-4">
                <x-button type="submit" blue>Guardar</x-button>
            </div>

        </form>

    </x-card>

</x-layouts.admin>

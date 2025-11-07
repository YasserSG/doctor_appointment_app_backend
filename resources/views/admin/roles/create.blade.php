<x-layouts.admin title="Roles | Healthify" :breadcrumbs="[
    [
        'name' => 'Dashboard', {{-- 2. Se usa 'text' y 'href' --}}
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
        'href' => route('admin.roles.index'),
    ],
]">

</x-layouts.admin>

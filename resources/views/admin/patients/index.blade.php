<x-layouts.admin title="Pacientes | Healthify" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Pacientes',
    ],
]">

    @livewire('admin.datatable.patient-table')

</x-layouts.admin>

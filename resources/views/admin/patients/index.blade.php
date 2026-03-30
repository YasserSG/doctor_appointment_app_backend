<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold">Gestión de Pacientes</h2>
                    
                    <form action="{{ route('admin.patients.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-2">
                        @csrf
                        <input type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
                        <x-wire-button primary type="submit">
                            Importar (En segundo plano)
                        </x-wire-button>
                    </form>
                </div>
                
                @if(session('success'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                @livewire('admin.datatables.patient-table')
            </div>
        </div>
    </div>
</x-admin-layout>

<x-admin-layout
    title="Nueva Cita | Admin"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Citas',
            'href' => route('admin.appointments.index'),
        ],
        [
            'name' => 'Nueva',
        ],
    ]">

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 max-w-4xl mx-auto">
        
        <form action="{{ route('admin.appointments.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Paciente -->
                <div>
                    <label for="patient_id" class="block text-sm font-medium text-gray-700">Paciente</label>
                    <select id="patient_id" name="patient_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" required>
                        <option value="">Seleccione un paciente</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                {{ optional($patient->user)->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('patient_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Doctor -->
                <div>
                    <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor</label>
                    <select id="doctor_id" name="doctor_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" required>
                        <option value="">Seleccione un doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                {{ optional($doctor->user)->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('doctor_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Fecha -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    @error('date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Hora Inicio -->
                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700">Hora de Inicio</label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    @error('start_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Hora Fin -->
                <div>
                    <label for="end_time" class="block text-sm font-medium text-gray-700">Hora de Fin</label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    @error('end_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Motivo -->
            <div class="mb-6">
                <label for="reason" class="block text-sm font-medium text-gray-700">Motivo de la Cita</label>
                <textarea id="reason" name="reason" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" required>{{ old('reason') }}</textarea>
                @error('reason') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.appointments.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancelar
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Guardar Cita
                </button>
            </div>
        </form>

    </div>
</x-admin-layout>

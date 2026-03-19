<div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 max-w-5xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center border-b pb-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Consulta para {{ $appointment->patient->user->name ?? 'Paciente' }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Doctor: {{ $appointment->doctor->user->name ?? 'No especificado' }} | Fecha: {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}</p>
                <div class="mt-2">
                    <span class="inline-block bg-gray-100 rounded-px py-1 text-sm text-gray-700"><strong>Motivo:</strong> {{ $appointment->reason }}</span>
                </div>
            </div>
            <div class="flex space-x-3 mt-4 sm:mt-0">
                <button wire:click="openHistoryModal" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    <i class="fa-solid fa-clock-rotate-left mr-2"></i> Consultas Anteriores
                </button>
                <button type="button" wire:click="redirectToPatientHistory" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    <i class="fa-solid fa-user-injured mr-2"></i> Ver Historia
                </button>
            </div>
        </div>

        <!-- Errores generales globales -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">¡Oh oh!</strong>
                <span class="block sm:inline">Revisa los errores a continuación.</span>
            </div>
        @endif

        <!-- Tabs -->
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button wire:click="setTab('consulta')" type="button" class="{{ $activeTab === 'consulta' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Consulta
                    @if($errors->has('diagnosis') || $errors->has('treatment') || $errors->has('notes'))
                        <span class="bg-red-100 text-red-600 ml-1 py-0.5 px-2 rounded-full text-xs">!</span>
                    @endif
                </button>

                <button wire:click="setTab('receta')" type="button" class="{{ $activeTab === 'receta' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Receta
                    @if($errors->has('medicines.*'))
                        <span class="bg-red-100 text-red-600 ml-1 py-0.5 px-2 rounded-full text-xs">!</span>
                    @endif
                </button>
            </nav>
        </div>

        <form wire:submit.prevent="save" class="mt-6">
            <!-- Consulta Tab Content -->
            <div class="{{ $activeTab === 'consulta' ? 'block' : 'hidden' }} space-y-6">
                <div>
                    <label for="diagnosis" class="block text-sm font-medium text-gray-700">Diagnóstico <span class="text-red-500">*</span></label>
                    <div class="mt-1">
                        <textarea wire:model="diagnosis" id="diagnosis" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md {{ $errors->has('diagnosis') ? 'border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500' : '' }}"></textarea>
                    </div>
                    @error('diagnosis') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="treatment" class="block text-sm font-medium text-gray-700">Tratamiento <span class="text-red-500">*</span></label>
                    <div class="mt-1">
                        <textarea wire:model="treatment" id="treatment" rows="4" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md {{ $errors->has('treatment') ? 'border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500' : '' }}"></textarea>
                    </div>
                    @error('treatment') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notas Adicionales (Opcional)</label>
                    <div class="mt-1">
                        <textarea wire:model="notes" id="notes" rows="2" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md {{ $errors->has('notes') ? 'border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500' : '' }}"></textarea>
                    </div>
                    @error('notes') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Receta Tab Content -->
            <div class="{{ $activeTab === 'receta' ? 'block' : 'hidden' }} space-y-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Medicamentos</h3>
                    
                    <div class="space-y-4">
                        @foreach($medicines as $index => $medicine)
                            <div class="flex items-start gap-4 p-4 border border-gray-200 rounded-md bg-gray-50 relative">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 w-full">
                                    <div class="col-span-1 lg:col-span-1">
                                        <label class="block text-xs font-medium text-gray-700">Medicamento <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model="medicines.{{ $index }}.name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md {{ $errors->has('medicines.'.$index.'.name') ? 'border-red-500' : '' }}">
                                        @error('medicines.'.$index.'.name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-span-1 lg:col-span-1">
                                        <label class="block text-xs font-medium text-gray-700">Dosis <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model="medicines.{{ $index }}.dosage" placeholder="Ej. 500mg" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md {{ $errors->has('medicines.'.$index.'.dosage') ? 'border-red-500' : '' }}">
                                        @error('medicines.'.$index.'.dosage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-span-1 lg:col-span-1">
                                        <label class="block text-xs font-medium text-gray-700">Frecuencia</label>
                                        <input type="text" wire:model="medicines.{{ $index }}.frequency" placeholder="Ej. Cada 8 horas" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="col-span-1 lg:col-span-1">
                                        <label class="block text-xs font-medium text-gray-700">Duración</label>
                                        <input type="text" wire:model="medicines.{{ $index }}.duration" placeholder="Ej. 5 días" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                                <button type="button" wire:click="removeMedicine({{ $index }})" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-full transition mt-5">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <button type="button" wire:click="addMedicine" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fa-solid fa-plus mr-2"></i> Agregar Medicamento
                        </button>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="mt-8 border-t border-gray-200 pt-5 flex justify-end">
                <a href="{{ route('admin.appointments.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-3">
                    Cancelar
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fa-solid fa-save mr-2 mt-1"></i> Guardar y Finalizar Consulta
                </button>
            </div>
        </form>

        <!-- History Modal -->
        @if($showHistoryModal)
        <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true" wire:click="closeHistoryModal"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start" style="width: 100%">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Consultas Anteriores
                                </h3>
                                <div class="mt-4 space-y-4">
                                    @forelse($pastConsultations as $past)
                                        <div class="border rounded p-4 bg-gray-50">
                                            <div class="flex justify-between items-center border-b pb-2 mb-2">
                                                <div class="text-sm font-semibold text-gray-800">Fecha: {{ \Carbon\Carbon::parse($past->date)->format('d/m/Y') }}</div>
                                                <div class="text-sm text-gray-600">Atendió: Doctor {{ $past->doctor->user->name ?? 'N/A' }}</div>
                                            </div>
                                            <div class="mt-2">
                                                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-500">Motivo</h4>
                                                <p class="text-sm text-gray-800 mt-1">{{ $past->reason }}</p>
                                            </div>
                                            <div class="mt-3">
                                                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-500">Diagnóstico</h4>
                                                <p class="text-sm text-gray-800 mt-1">{{ $past->diagnosis }}</p>
                                            </div>
                                            <div class="mt-3">
                                                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-500">Tratamiento</h4>
                                                <p class="text-sm text-gray-800 mt-1">{{ $past->treatment }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-6 text-center text-gray-500 border border-dashed rounded bg-gray-50">
                                            No hay consultas atendidas anteriormente para este paciente.
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" wire:click="closeHistoryModal" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

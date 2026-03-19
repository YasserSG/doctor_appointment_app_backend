<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\Appointment;

class ConsultationManager extends Component
{
    public Appointment $appointment;
    
    public $activeTab = 'consulta';
    public $showHistoryModal = false;
    
    public $diagnosis;
    public $treatment;
    public $notes;
    
    public array $medicines = [];
    
    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment->load('patient.user', 'doctor.user');
        
        if ($appointment->status == 2) {
            $this->diagnosis = $appointment->diagnosis;
            $this->treatment = $appointment->treatment;
            $this->notes = $appointment->notes;
            $this->medicines = is_string($appointment->medicines) ? json_decode($appointment->medicines, true) : ($appointment->medicines ?? []);
        } else {
            $this->addMedicine();
        }
    }
    
    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function addMedicine()
    {
        $this->medicines[] = ['name' => '', 'dosage' => '', 'frequency' => '', 'duration' => ''];
    }
    
    public function removeMedicine($index)
    {
        unset($this->medicines[$index]);
        $this->medicines = array_values($this->medicines);
    }
    
    public function openHistoryModal()
    {
        $this->showHistoryModal = true;
    }
    
    public function closeHistoryModal()
    {
        $this->showHistoryModal = false;
    }
    
    public function redirectToPatientHistory()
    {
        return redirect()->route('admin.patients.edit', $this->appointment->patient_id);
    }
    
    public function save()
    {
        $this->validate([
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
            'medicines.*.name' => 'required|string',
            'medicines.*.dosage' => 'required|string',
        ], [
            'diagnosis.required' => 'El campo Diagnóstico es requerido.',
            'treatment.required' => 'El campo Tratamiento es requerido.',
            'medicines.*.name.required' => 'El nombre del medicamento es requerido.',
            'medicines.*.dosage.required' => 'La dosis es requerida.',
        ]);
        
        $this->appointment->update([
            'status' => 2,
            'diagnosis' => $this->diagnosis,
            'treatment' => $this->treatment,
            'notes' => $this->notes,
            'medicines' => json_encode($this->medicines),
        ]);
        
        session()->flash('alert', [
            'type'    => 'success',
            'message' => 'Consulta guardada correctamente',
        ]);
        
        return redirect()->route('admin.appointments.index');
    }

    public function render()
    {
        $pastConsultations = \App\Models\Appointment::where('patient_id', $this->appointment->patient_id)
            ->where('status', 2)
            ->where('id', '!=', $this->appointment->id)
            ->with('doctor.user')
            ->orderBy('date', 'desc')
            ->get();
            
        return view('livewire.admin.consultation-manager', [
            'pastConsultations' => $pastConsultations
        ]);
    }
}

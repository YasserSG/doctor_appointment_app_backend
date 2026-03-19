<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient.user', 'doctor.user'])->orderBy('date', 'desc')->orderBy('start_time', 'desc')->paginate(15);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::with('user')->get();
        $doctors = Doctor::with('user')->get();
        return view('admin.appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id'  => 'required|exists:doctors,id',
            'date'       => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
            'reason'     => 'required|string',
        ]);

        Appointment::create($request->all());

        session()->flash('alert', [
            'type'    => 'success',
            'message' => 'Cita registrada correctamente.',
        ]);

        return redirect()->route('admin.appointments.index');
    }

    public function show(string $id)
    {
        //
    }

    public function consultation(Appointment $appointment)
    {
        return view('admin.appointments.consultation', compact('appointment'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}

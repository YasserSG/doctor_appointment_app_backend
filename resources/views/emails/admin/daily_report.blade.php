<x-mail::message>
# Reporte Diario de Citas Médicas

Este es el reporte automático de todos los pacientes agendados para hoy, **{{ date('d-m-Y') }}**.

@if($appointments->count() > 0)
<x-mail::table>
| Hora | Paciente | Médico | Especialidad |
|:-----|:---------|:-------|:-------------|
@foreach($appointments as $appointment)
| {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} | {{ $appointment->patient->user->name }} | {{ $appointment->doctor->user->name }} | {{ $appointment->doctor->speciality->name ?? 'General' }} |
@endforeach
</x-mail::table>
@else
**No hay ninguna cita programada para el día de hoy.**
@endif

Que tenga un excelente día,<br>
Sistema de Citas Médicas
</x-mail::message>

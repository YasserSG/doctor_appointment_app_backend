<x-mail::message>
# ¡Su cita ha sido agendada con éxito!

Hola **{{ $appointment->patient->user->name }}**,

Le confirmamos que su cita médica con el/la Dr/a. **{{ $appointment->doctor->user->name }}** ha sido programada para el **{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}** a las **{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}**.

Adjunto a este correo encontrará su comprobante en formato PDF con todos los detalles de su visita.

Si tiene alguna duda, comuníquese con nosotros.

Gracias por su confianza,<br>
La Administración
</x-mail::message>

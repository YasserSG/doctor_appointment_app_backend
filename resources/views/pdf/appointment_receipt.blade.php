<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Cita Médica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0ea5e9;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #0ea5e9;
            margin: 0;
        }
        .content {
            margin: 0 auto;
            max-width: 600px;
        }
        .details {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 20px;
            border-radius: 8px;
        }
        .details h3 {
            margin-top: 0;
            color: #1e293b;
        }
        .details p {
            margin: 5px 0;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Clínica Médica</h1>
        <p>Comprobante Oficial de Cita</p>
    </div>

    <div class="content">
        <p>Estimado/a <strong>{{ $appointment->patient->user->name }}</strong>,</p>
        <p>Este documento sirve como comprobante de su cita médica agendada en nuestro sistema.</p>

        <div class="details">
            <h3>Detalles de la Cita</h3>
            <p><strong>Paciente:</strong> {{ $appointment->patient->user->name }}</p>
            <p><strong>Médico:</strong> Dr/a. {{ $appointment->doctor->user->name }}</p>
            <p><strong>Especialidad:</strong> {{ $appointment->doctor->speciality->name ?? 'Medicina General' }}</p>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</p>
            <p><strong>Hora de inicio:</strong> {{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}</p>
            <p><strong>Hora de fin:</strong> {{ \Carbon\Carbon::parse($appointment->end_time)->format('H:i') }}</p>
            <p><strong>Motivo:</strong> {{ $appointment->reason }}</p>
        </div>

        <p>Por favor, preséntese 15 minutos antes de la hora acordada.</p>
    </div>

    <div class="footer">
        <p>Este es un documento generado de forma automática. Clínica Médica &copy; {{ date('Y') }}</p>
    </div>
</body>
</html>

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use App\Mail\DailyAppointmentReport;
use Illuminate\Support\Facades\Mail;

class SendDailyAppointmentReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-appointment-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un reporte diario de las citas medicas al administrador';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = \Carbon\Carbon::today();
        $appointments = Appointment::with(['patient.user', 'doctor.user', 'doctor.speciality'])
            ->whereDate('date', $today)
            ->orderBy('start_time')
            ->get();

        // Send the report to the administrator email
        Mail::to('admin@clinic.com')->send(new DailyAppointmentReport($appointments));

        $this->info('Reporte diario enviado a admin@clinic.com. Citas agendadas: ' . $appointments->count());
    }
}

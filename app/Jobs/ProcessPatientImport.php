<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PatientsImport;
use Illuminate\Support\Facades\Storage;

class ProcessPatientImport implements ShouldQueue
{
    use Queueable;

    public $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Leer el archivo de almacenamiento local y procesarlo
        Excel::import(new PatientsImport, $this->filePath);

        // Opcional: Eliminar el archivo después de procesarlo para no saturar el servidor
        if (Storage::exists($this->filePath)) {
            Storage::delete($this->filePath);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\ProcessPatientImport;

class PatientImportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx,xls|max:10240',
        ]);

        // Guardar el archivo en el almacenamiento local para que el Job pueda leerlo
        $path = $request->file('file')->store('imports');

        // Despachar el Job a la cola en segundo plano
        ProcessPatientImport::dispatch($path);

        return redirect()->route('admin.patients.index')->with('success', 'El archivo se está procesando en segundo plano. Los pacientes se importarán pronto.');
    }
}

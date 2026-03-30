<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Patient;
use App\Models\BloodType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PatientsImport implements OnEachRow, WithHeadingRow, WithChunkReading
{
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        // Prevent empty rows
        if (!isset($row['correo']) || empty($row['correo'])) {
            return;
        }

        $user = User::firstOrCreate(
            ['email' => $row['correo']],
            [
                'name' => $row['nombre_completo'],
                'password' => Hash::make('password123'),
                'phone' => $row['telefono'] ?? '0000000000',
                'address' => 'Desconocida',
                'id_number' => Str::upper(Str::random(10)),
                'date_of_birth' => $row['fecha_nacimiento'] ?? null,
            ]
        );

        if (!$user->hasRole('paciente')) {
            $user->assignRole('paciente');
        }

        $bloodTypeId = null;
        if (!empty($row['tipo_sangre'])) {
            $bloodType = BloodType::where('name', $row['tipo_sangre'])->first();
            if ($bloodType) {
                $bloodTypeId = $bloodType->id;
            }
        }

        Patient::updateOrCreate(
            ['user_id' => $user->id],
            [
                'blood_type_id' => $bloodTypeId,
                'allergies' => ($row['alergias'] !== 'Ninguna' && !empty($row['alergias'])) ? $row['alergias'] : null,
            ]
        );
    }

    public function chunkSize(): int
    {
        return 500;
    }
}

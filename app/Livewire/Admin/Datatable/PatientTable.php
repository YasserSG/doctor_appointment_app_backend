<?php

namespace App\Livewire\Admin\Datatable;

use App\Models\Patient;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class PatientTable extends DataTableComponent
{
    //protected $model = Patient::class;
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    //Este metodo define el modelo
    public function builder(): Builder
    {
    return Patient::query()
        ->with('user');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "user.name")
                ->sortable(),
            Column::make("Email", "user.email")
                ->sortable(),
            Column::make("Número de id", "user.id_number")
                ->sortable(),
            Column::make("Telefono", "user.phone")
                ->sortable(),
            Column:: make("Acciones")
                ->label(function($row){
                    return view('admin.patients.actions',
                ['patient' => $row]);
            })
        ];
    }
}

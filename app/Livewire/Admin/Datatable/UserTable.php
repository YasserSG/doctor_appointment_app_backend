<?php

namespace App\Livewire\Admin\Datatable;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Número de id", "id_number")
                ->sortable(),
            Column::make("Teléfono", "phone")
                ->sortable(),
            Column::make("Role", "roles")
                ->label(function($row){
                    return $row->roles->first()?->name ?? 'Sin rol';
                }),
            Column:: make("Acciones")
            ->label(function($row){
                return view('admin.users.actions',
                ['row' => $row]);
            })
        ];
    }
}

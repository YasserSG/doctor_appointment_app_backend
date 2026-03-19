<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Panel principal del admin
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Gestión de Roles
    Route::resource('roles', RoleController::class);

    // Gestión de Usuarios
    Route::resource('users', UserController::class);

    // Gestión de Pacientes
    Route::resource('patients', \App\Http\Controllers\Admin\PatientController::class)->only(['index', 'create', 'edit', 'update']);

    // Gestión de Doctores
    Route::resource('doctors', \App\Http\Controllers\Admin\DoctorController::class);

    // Horarios de doctor
    Route::get('doctors/{doctor}/schedules', [\App\Http\Controllers\Admin\DoctorController::class, 'schedules'])->name('doctors.schedules');

    // Gestión de Citas
    Route::resource('appointments', \App\Http\Controllers\Admin\AppointmentController::class);

    // Consulta de citas
    Route::get('appointments/{appointment}/consultation', [\App\Http\Controllers\Admin\AppointmentController::class, 'consultation'])->name('appointments.consultation');
});
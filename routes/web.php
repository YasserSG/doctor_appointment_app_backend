<?php

use Illuminate\Support\Facades\Route;

// 1. CAMBIO AQUÍ: Redirige la raíz '/' a la ruta protegida 'dashboard'.
// El nombre 'dashboard' ya está definido más abajo.
Route::redirect('/', '/dashboard');

// Las rutas de autenticación de Jetstream (login, register, etc.) se definen automáticamente antes de esto.

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // 2. CAMBIO AQUÍ: Usa la ruta existente 'dashboard', pero apunta a tu vista de administrador.
    Route::get('/dashboard', function () {
        // Jetstream por defecto apunta a 'dashboard.blade.php'
        // Lo cambiamos para que apunte a tu vista de administrador
        return view('admin.dashboard');
    })->name('dashboard'); // <-- Mantenemos el nombre de ruta original 'dashboard'
});

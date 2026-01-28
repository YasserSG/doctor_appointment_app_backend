<?php

use App\Models\User;

it('fails to update user when data is invalid', function () {
    // 1. Creamos al admin y al usuario original
    $admin = User::factory()->create();
    $user = User::factory()->create([
        'name' => 'Original Name',
        'email' => 'original@example.com'
    ]);

    // 2. Intentamos actualizar con datos que rompen las reglas:
    // - Name: 'ab' (falla porque el profesor pide min:3)
    // - Email: 'not-an-email' (falla el formato)
    $response = $this->actingAs($admin)
        ->put(route('admin.users.update', $user), [
            'name' => 'ab',
            'email' => 'not-an-email',
            'id_number' => '123', // Falla porque pide min:5
            'phone' => '123',     // Falla porque pide entre 7 y 15 dígitos
        ]);

    // 3. Verificamos que existan errores de validación en la sesión para estos campos
    $response->assertSessionHasErrors(['name', 'email', 'id_number', 'phone']);

    // 4. Verificamos que en la base de datos NADA haya cambiado
    $user->refresh();
    expect($user->name)->toBe('Original Name');
    expect($user->email)->toBe('original@example.com');
});

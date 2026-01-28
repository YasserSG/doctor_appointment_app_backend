<?php

use App\Models\User;

it('fails to update user when data is invalid', function () {
    $admin = User::factory()->create();
    $user = User::factory()->create(['email' => 'original@example.com']);

    // Enviamos datos que rompen las reglas (nombre muy corto y email mal formado)
    $response = $this->actingAs($admin)
        ->put(route('admin.users.update', $user), [
            'name' => 'ab', // Falla min:3
            'email' => 'correo-invalido', // Falla formato email
        ]);

    // Verifica que existan errores de validación en la sesión
    $response->assertSessionHasErrors(['name', 'email']);

    // Verifica que los datos en la BD no hayan cambiado
    $user->refresh();
    expect($user->email)->toBe('original@example.com');
});

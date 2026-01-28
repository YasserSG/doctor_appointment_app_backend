<?php

use App\Models\User;

it('prevents creating a user with an existing email', function () {
    // 1. Creamos un usuario ya existente en la base de datos
    $existingUser = User::factory()->create([
        'email' => 'test@example.com'
    ]);

    // 2. Intentamos crear OTRO usuario con el mismo email
    // Usamos actingAs para simular que estamos logueados
    $response = $this->actingAs($existingUser)
        ->post(route('admin.users.store'), [
            'name' => 'Nuevo Usuario',
            'email' => 'test@example.com', // Email duplicado
            'password' => 'password123',
        ]);

    // 3. Verificamos que el sistema detecte el error de validación
    $response->assertSessionHasErrors('email');

    // 4. Verificamos que en la base de datos solo siga existiendo 1 usuario
    $this->assertDatabaseCount('users', 1);
});

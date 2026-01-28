<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


// Usar la funcion para refrescar la base de datos
Uses(RefreshDatabase::class);

test('Un usuario no puede eliminarse a si mismo', function () {
    //1) crear un usario de prueba
    $user = User::factory()->create();

    //2) Simular que ese usario ya inició sesión
    $this->actingAs($user, 'web');

    //3) Simular una peticion HTTP DELETE (borrar un usario )
    $response = $this->delete(route('admin.users.destroy', $user));

    //4) Esperar que el servidor bloquee el borrado a si mismo
    $response->assertStatus(403);

    //5) verificar en la DB que sigue existiendo ese usario
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
    ]);
});

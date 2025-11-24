<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //crear un usuario de prueba de cada que se ejecuten migraciones
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            // CORRECCIÓN: Quitamos bcrypt(). Laravel lo encriptará automáticamente.
            'password' => '12345678',
            'id_number' => '12345678',
            'phone' => '5555555555',
            'address' => 'Test Address',
        ])->assignRole('Doctor');
    }
}

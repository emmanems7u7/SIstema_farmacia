<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    // User::factory()->create([
    //   'name' => 'Test User',
    // 'email' => 'test@example.com',
    // ]);

    //$administrador = Role::create(['name'=>'ADMINISTRADOR']);

    $administrador = Role::where('name', 'ADMINISTRADOR')->first();

    // Verificar si el rol existe antes de asignarlo
    if ($administrador) {
      // Crear el usuario administrador
      $admin = User::create([
        'name' => 'Jessica',
        'email' => 'jessica@gmail.com',
        'password' => Hash::make('12'), // Cambia la contraseña
        'sucursal_id' => 1, // Ajusta según sea necesario
      ]);

      // Asignar el rol al usuario
      $admin->assignRole($administrador);

    }
  }
}
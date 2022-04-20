<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role1 = Role::create(['name' => 'Administrador']);
      $role2 = Role::create(['name' => 'Dependencia']);
      $role3 = Role::create(['name' => 'Usuario']);

      Permission::create(['name' => 'create usuario'])->syncRoles([$role1,$role2]);
      Permission::create(['name' => 'editar usuario'])->syncRoles([$role1,$role2,$role3]);
      Permission::create(['name' => 'eliminar usuario'])->syncRoles([$role1]);
    }
}

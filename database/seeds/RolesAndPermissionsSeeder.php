<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $propositor       = Role::firstOrCreate([
        'name'=>'propositor'
      ]);

      $admin            = Role::firstOrCreate([
        'name'=>'admin'
      ]);

      $parecerista      = Role::firstOrCreate([
        'name'=>'parecerista'
      ]);

      $enviarProposta       = Permission::firstOrCreate([
        'name'=>'enviar-proposta'
      ]);

      $avaliarProposta       = Permission::firstOrCreate([
        'name'=>'avaliar-proposta'
      ]);

      $propositor->attachPermission($enviarProposta);
      $parecerista->attachPermission($avaliarProposta);

    }
}

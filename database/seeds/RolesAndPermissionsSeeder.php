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
      $propositor       = new Role();
      $propositor->name = 'propositor';
      $propositor->save();

      $admin       = new Role();
      $admin->name = 'admin';
      $admin->save();

      $enviarProposta = new Permission();
      $enviarProposta->name = 'enviar-proposta';
      $enviarProposta->save();

      $propositor->attachPermission($enviarProposta);

    }
}

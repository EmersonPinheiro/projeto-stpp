<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\Pessoa;
use App\User;
use App\UsuarioAdmin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $this->call('AdminTableSeeder');

    }
}

class AdminTableSeeder extends Seeder
{
  public function run()
  {
    $pessoa = Pessoa::firstOrNew([
      'cpf'=>'09165842910',
      'nome'=>'Gabriel',
      'sobrenome'=>'Moreira',
      'sexo'=>'M',
      'logradouro'=>'Rua Marques',
      'bairro'=>'Orfãs',
      'CEP'=>'84015030',
      'Cidade_cod_cidade'=>'1',
    ]);

    //$pessoa->save();
    $idPessoa = $pessoa->cod_pessoa;

    var_dump($idPessoa);
/*
    $user = User::firstOrNew([
      'email'=>'gabrielmoliveira@mail.com',
      'password'=>bcrypt('123456'),
      'Pessoa_cod_pessoa'=>$idPessoa,
    ]);



    //$user->save();

    $useradmin = UsuarioAdmin::firstOrNew([
      'Usuario_cod_usuario'=>$user->id,
    ]);

    $role = Role::where('name', 'admin');
    $useradmin->attachRole($role);
    //  $useradmin->save();*/
  }
}

<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\Pessoa;
use App\User;
use App\UsuarioAdmin;
use App\Cidade;
use App\Pais;
use App\EstadoProvincia;

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

    $pais = Pais::firstOrCreate([
      'nome'=>'Brasil',
    ]);

    $estado = EstadoProvincia::firstOrCreate([
      'nome'=>'Paraná',
      'sigla'=>'PR',
      'Pais_cod_pais'=>$pais->cod_pais
    ]);

    $cidade = Cidade::firstOrCreate([
      'nome'=>'Ponta Grossa',
      'Estado_provincia_cod_est_prov'=>$estado->cod_est_prov
    ]);

    $pessoa = Pessoa::firstOrCreate([
      'cpf'=>'09165842910',
      'nome'=>'Gabriel',
      'sobrenome'=>'Moreira',
      'sexo'=>'M',
      'logradouro'=>'Rua Marques',
      'bairro'=>'Orfãs',
      'CEP'=>'84015030',
      'Cidade_cod_cidade'=>$cidade->cod_cidade,
    ]);

    $user = User::firstOrCreate([
      'email'=>'gabrielmoliveira@gmail.com',
      'password'=>bcrypt('123456'),
      'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
    ]);

    $userAdmin = UsuarioAdmin::firstOrCreate([
      'Usuario_cod_usuario'=>$user->cod_usuario,
    ]);

    $user->attachRole(2);

  }
}

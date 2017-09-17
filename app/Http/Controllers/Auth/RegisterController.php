<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome'=>'required|min:3|max:50',
            'sobrenome'=>'required|min:3|max:100',
            'cpf'=>'required|min:11|max:11',
            'sexo'=>'required',
            'email'=>'required|email|string|max:255',
            'cidade'=>'required|min:3',
            'estado'=>'required|min:3',
            'pais'=>'required|min:3',
            'password'=>'required|string|min:6|confirmed',
            'password_confirmation'=>'required|string|min:6'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //inserir em 6 tabelas (pessoa, email, cidade, estado, pais, usuario)
        //VERIFICAR INSERSÃO DE VALORES IGUAIS

        $idPais = DB::table('Pais')->insertGetID([
          'nome'=>$data['pais'],
        ]);

        $idEstProv = DB::table('Estado_provincia')->insertGetID([
         'nome'=>$data['estado'],
         //falta uf
         'Pais_cod_pais'=>$idPais,
        ]);

         $idCidade = DB::table('Cidade')->insertGetID([
          'nome'=>$data['cidade'],
          'Estado_provincia_cod_est_prov'=>$idEstProv,
        ]);

        $idPessoa = DB::table('Pessoa')->insertGetID([
          'cpf'=>$data['cpf'],
          'nome'=>$data['nome'],
          'sobrenome'=>$data['sobrenome'],
          'sexo'=>$data['sexo'],
          'Cidade_cod_cidade'=>$idCidade,
        ]);
/*
        DB::table('Email')->insert([
          'endereco'=>$data['email'],
          'tipo'=>'1',
          'Pessoa_cod_pessoa'=>$idPessoa,
        ]);
*/
        $usuario = User::create([
           'email'=>$data['email'],
           'password'=>bcrypt($data['password']),
           'Pessoa_cod_pessoa'=>$idPessoa,
        ]);

        //var_dump($usuario);
        return $usuario;

    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Permission;
use App\UsuarioPropositor;
use App\UsuarioParecerista;
use App\Pais;
use App\EstadoProvincia;
use App\Cidade;
use App\Pessoa;
use App\Instituicao;
use App\Setor;
use App\Departamento;
use App\ConviteParecerista;
use App\Proposta;
use App\Material;
use App\Parecer;
use Carbon\Carbon;
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
        $messages = [
          'required'=>'O campo :attribute é obrigatório.',
          'min'=>'O campo :attribute deve ter no mínimo :min caracteres.',
          'max'=>'O campo :attribute deve ter no máximo :max caracteres.',
          'numeric'=>'O campo :attribute deve conter apenas números.',
          'password.required'=>'O campo senha é obrigatório.',
          'password_confirmation.required'=>'O campo de confirmação de senha é obrigatório.'
        ];

        return Validator::make($data, [
            'nome'=>'required|min:3|max:50',
            'sobrenome'=>'required|min:3|max:100',
            'cpf'=>'required|min:11|max:11',
            'rg'=>'required|max:14',
            'estado_civil' =>'required',
            'sexo'=>'required',
            'email'=>'required|email|string|max:255',
            'email_secundario'=>'email|nullable',
            'telefone'=>'required|numeric',
            'telefone_secundario'=>'numeric|nullable',
            'instituicao'=>'required|string',
            'grande_area'=>'required|string',
            'area_conhecimento'=>'required|string',
            'cidade'=>'required|min:3',
            'estado'=>'required|min:3',
            'pais'=>'required|min:3',
            'logradouro'=>'required',
            'bairro'=>'required',
            'cep'=>'required|numeric',
            'password'=>'required|string|min:6|confirmed',
            'password_confirmation'=>'required|string|min:6'
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //VERIFICAR INSERSÃO DE VALORES IGUAIS

        $pais = Pais::firstOrCreate([
          'nome'=>$data['pais']
        ]);

        $estProv = EstadoProvincia::firstOrCreate([
          'nome'=>$data['estado'],
          //falta uf
          'Pais_cod_pais'=>$pais->cod_pais
        ]);

        $cidade = Cidade::firstOrCreate([
          'nome'=>$data['cidade'],
          'Estado_provincia_cod_est_prov'=>$estProv->cod_est_prov
        ]);

        $pessoa = Pessoa::create([
          'cpf'=>$data['cpf'],
          'rg'=>$data['rg'],
          'nome'=>$data['nome'],
          'sobrenome'=>$data['sobrenome'],
          'sexo'=>$data['sexo'],
          'estado_civil'=>$data['estado_civil'],
          'logradouro'=>$data['logradouro'],
          'bairro'=>$data['bairro'],
          'CEP'=>$data['cep'],
          'Cidade_cod_cidade'=>$cidade->cod_cidade,
        ]);

        DB::table('Email')->insert([
          'endereco'=>$data['email'],
          'tipo'=>'1',
          'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
        ]);

        if($data['email_secundario'] != null){
          DB::table('Email')->insert([
            'endereco'=>$data['email_secundario'],
            'tipo'=>'2',
            'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
          ]);
        }

        DB::table('Telefone')->insert([
          'numero'=>$data['telefone'],
          'tipo'=>'1',
          'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
        ]);

        if ($data['telefone_secundario'] != null) {
          DB::table('Telefone')->insert([
            'numero'=>$data['telefone_secundario'],
            'tipo'=>'2',
            'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
          ]);
        }

        $instituicao = Instituicao::firstOrCreate([
          'nome'=>$data['instituicao'],
        ]);

        $setor = Setor::firstOrCreate([
          'nome'=>$data['setor'],
          'Instituicao_cod_instituicao'=>$instituicao->cod_instituicao
        ]);

        $departamento = Departamento::firstOrCreate([
            'nome'=>$data['departamento'],
            'Setor_cod_setor'=>$setor->cod_setor
        ]);

        $usuario = User::create([
           'email'=>$data['email'],
           'password'=>bcrypt($data['password']),
           'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
        ]);

        $attributes = $usuario->getAttributes();

        if ($data['tipo']=='propositor') {
          $usuarioPropositor = UsuarioPropositor::create([
            'Usuario_cod_usuario'=>$attributes['cod_usuario'],
            'Departamento_cod_departamento'=>$departamento->cod_departamento
          ]);

          $usuario->attachRole(1);
        }
        elseif ($data['tipo']=='parecerista') {
          $usuarioParecerista = UsuarioParecerista::create([
            'Usuario_cod_usuario'=>$attributes['cod_usuario'],
            'Departamento_cod_departamento'=>$departamento->cod_departamento
          ]);

          $convite = ConviteParecerista::where('token', '=', $data['convite'])->first();

          $proposta = Proposta::where('cod_proposta', '=', $convite->proposta)->first();

          $parecer = Parecer::create([
            //TODO: Implementar prazo.
            'prazo_envio'=>Carbon::now('America/Sao_Paulo')->addDays(0)->format('Y-m-d'),
            'Proposta_cod_proposta'=>$proposta->cod_proposta,
            'Usuario_Parecerista_cod_parecerista'=>$usuarioParecerista->cod_parecerista,
          ]);

          //TODO: informações específicas do parecerista

          $convite->delete(); //Deleta o convite após o cadastro do parecerista

          $usuario->attachRole(3);//Associa a role 'parecerista'.
        }

        return $usuario;

    }
}

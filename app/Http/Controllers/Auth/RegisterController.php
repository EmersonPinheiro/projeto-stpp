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
use App\ConviteParecerista;
use App\Proposta;
use App\Material;
use App\Parecer;
use App\VinculoInstitucional;
use App\GrandeArea;
use App\AreaConhecimento;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\ConfirmacaoCadastro;
use Illuminate\Http\Request;

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
    protected function validator($data)
    {
        $messages = [
          'password.required'=>'O campo senha é obrigatório.',
          'password_confirmation.required'=>'O campo de confirmação de senha é obrigatório.'
        ];

        return Validator::make($data, [
            'nome'=>'required|min:1|max:50|string',
            'sobrenome'=>'required|min:1|max:100|string',
            'sexo'=>'required',
            'cpf'=>'required|digits:11|unique:Pessoa,cpf|cpf_valido',
            'rg'=>'required|digits_between:6,14|unique:Pessoa,rg',
            'estado_civil'=>'required',

            'instituicao'=>'required|min:2|max:100',
            'sigla'=>'nullable|min:2|max:20',
            'vinculo'=>'nullable|min:2|max:200',

            'logradouro'=>'required|min:2|max:255',
            'bairro'=>'required|min:2|max:50',
            'cep'=>'required|digits:8',
            'cidade'=>'required|min:2|max:50',
            'estado'=>'required|min:2|max:50',
            'pais'=>'required|min:2|max:50',
            'telefone'=>'required|digits_between:6,14',
            'telefone_secundario'=>'nullable|digits_between:6,14',
            'email_secundario'=>'nullable|email|max:100',

            //'grande_area'=>'required|min:2|max:100|alpha',
            //'area_conhecimento'=>'required|min:2|max:100|alpha',
            //'subarea'=>'nullable|min:2|max:100|alpha',
            //'especialidade'=>'nullable|min:2|max:100|alpha',

            'email'=>'required|email|max:100|unique:Usuario,email',
            'password'=>'required|min:6|max:60|confirmed',
            'password_confirmation'=>'required|min:6|max:60'

        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $data)
    {
        //VERIFICAR INSERSÃO DE VALORES IGUAIS
        $validator = $this->validator($data->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $data, $validator
            );
        }


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
          'slug'=>uniqid(),
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

        if ($data['vinculo'] != null) {
          $vinculo = VinculoInstitucional::firstOrCreate([
            'nome'=>$data['vinculo'],
            'Instituicao_cod_instituicao'=>$instituicao->cod_instituicao,
          ]);
        }

        $confirmation_token = str_random(30);
        $usuario = User::create([
           'email'=>$data['email'],
           'password'=>bcrypt($data['password']),
           'confirmation_token'=>$confirmation_token,
           'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
        ]);

        $attributes = $usuario->getAttributes();

        if ($data['tipo']=='propositor') {
          $usuarioPropositor = UsuarioPropositor::create([
            'Usuario_cod_usuario'=>$attributes['cod_usuario'],
            'Instituicao_cod_instituicao'=>$instituicao->cod_instituicao,
          ]);

          $usuario->attachRole(1);
        }
        elseif ($data['tipo']=='parecerista') {

          $grandeArea = GrandeArea::firstOrCreate([
            'nome'=>$data['grande_area'],
          ]);

          $areaConhecimento = AreaConhecimento::firstOrCreate([
            'nome'=>$data['area_conhecimento'],
            'Grande_Area_cod_grande_area'=>$grandeArea->cod_grande_area,
          ]);

          $usuarioParecerista = UsuarioParecerista::create([
            'Usuario_cod_usuario'=>$attributes['cod_usuario'],
            'Instituicao_cod_instituicao'=>$instituicao->cod_instituicao,
            'Grande_Area_cod_grande_area'=>$grandeArea->cod_grande_area,
          ]);

          $convite = ConviteParecerista::where('token', '=', $data['convite'])->first();

          $proposta = Proposta::where('cod_proposta', '=', $convite->Proposta_cod_proposta)->first();

          $parecer = Parecer::create([

            //TODO: Implementar prazo.
            'prazo_envio'=>Carbon::now('America/Sao_Paulo')->addDays(61)->format('Y-m-d'),
            'Proposta_cod_proposta'=>$proposta->cod_proposta,
            'Usuario_Parecerista_cod_parecerista'=>$usuarioParecerista->cod_parecerista,
          ]);

          //TODO: informações específicas do parecerista

          $convite->delete(); //Deleta o convite após o cadastro do parecerista

          $usuario->attachRole(3);//Associa a role 'parecerista'.
        }

        Mail::to($usuario->email)->send(new ConfirmacaoCadastro($usuario->confirmation_token));

        return redirect('/')->with('status', 'Cadastro efetuado com sucesso, por favor verifique sua caixa de e-mails e confirme seu cadastro clicando no link de confirmação.');
    }

    public function confirmation($confirmation_token)
    {
        if (!$confirmation_token) {
          abort(404);
        }

        if (!$usuario = User::where('confirmation_token', '=', $confirmation_token)->first()) {
          abort(404);
        }

        $usuario->confirmed = 1;
        $usuario->confirmation_token = null;
        $usuario->save();

        return redirect('/')->with('status', 'Cadastro confirmado! Faça login para ter acesso ao sistema.');
    }
}

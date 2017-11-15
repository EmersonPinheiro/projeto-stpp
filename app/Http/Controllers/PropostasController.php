<?php

namespace App\Http\Controllers;

use App\Pais;
use App\EstadoProvincia;
use App\Cidade;
use App\Role;
use App\Permission;
use App\User;
use App\Obra;
use App\Proposta;
use App\Autor;
use App\Pessoa;
use App\Instituicao;
use App\Setor;
use App\Departamento;
use App\GrandeArea;
use App\AreaConhecimento;
use App\Subarea;
use App\Especialidade;
use App\AutorEspecialidade;
use App\Material;
use App\Telefone;
use App\Email;
use App\UsuarioPropositor;
use App\UsuarioAdmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PropostaFormRequest;
use App\Http\Requests\PropostaEditFormRequest;
use App\Http\Requests\CancelamentoFormRequest;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PropostaEnviada;
use App\Notifications\CancelamentoSolicitado;

class PropostasController extends Controller
{

    public function __construct()
    {
      if (!Auth::check()) {
        return redirect('/');
      }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $usuario = Auth::user();
      $dadosUsuario = $usuario->getAttributes();
      $idUsuario = $dadosUsuario['cod_usuario'];

      $propositor = UsuarioPropositor::join('Usuario', 'Usuario.cod_usuario', '=', 'Usuario_Propositor.Usuario_cod_usuario')
                        ->where('Usuario.cod_usuario', $idUsuario)
                        ->select('Usuario_Propositor.cod_propositor')
                        ->first();

      $propostas = Proposta::join('Obra', 'Obra.Proposta_cod_proposta', '=', 'Proposta.cod_proposta')
                        ->where('Usuario_Propositor_cod_propositor', $propositor->cod_propositor)
                        ->select('Obra.titulo', 'Obra.subtitulo', 'Obra.descricao', 'Obra.cod_obra', 'Proposta.data_envio', 'Proposta.cod_proposta', 'Proposta.situacao')
                        ->get();

      return view('propostas', compact('propostas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = Auth::user();

        if (!$usuario->can('enviar-proposta')) {
          return redirect()->back()->withErrors('Ação não permitida.');
        }


        $autor = User::join('Pessoa', 'Usuario.Pessoa_cod_pessoa', '=', 'Pessoa.cod_pessoa')
                      ->where('cod_usuario', $usuario->cod_usuario)->first();

        return view('propostas.create', compact('autor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropostaFormRequest $request)
    {

        $usuario = Auth::user();

        $propositor = DB::table('Usuario_Propositor')->join('Usuario', 'Usuario.cod_usuario', '=', 'Usuario_Propositor.Usuario_cod_usuario')
                              ->where('Usuario.cod_usuario', $usuario->cod_usuario)
                              ->select('Usuario_Propositor.cod_propositor')
                              ->first();

        $proposta = Proposta::create([
          'data_envio'=>Carbon::now('America/Sao_Paulo')->format('Y-m-d'),
          'Usuario_Propositor_cod_propositor'=>$propositor->cod_propositor,
        ]);

       if (!$pessoa = Pessoa::where('cpf', '=', $request->get('CPF'))->first()) {  // Verifica cpf duplicado.
          $pessoa = Pessoa::create([
            'cpf'=>$request->get('CPF'),
            'rg'=>$request->get('rg'),
            'nome'=>$request->get('nome'),
            'sobrenome'=>$request->get('sobrenome'),
            'sexo'=>$request->get('sexo'),
            'estado_civil'=>$request->get('estado_civil'),
            'logradouro'=>$request->get('logradouro'),
            'bairro'=>$request->get('bairro'),
            'CEP'=>$request->get('cep'),
            'Cidade_cod_cidade'=>$cidade->cod_cidade,
          ]);
      }


        //Áreas de conhecimento da obra
        $grandeAreaObra = GrandeArea::firstOrCreate([
          'nome'=>$request->get('grande_area_obra'),
        ]);

        $areaConhecimentoObra = AreaConhecimento::firstOrCreate([
          'nome'=>$request->get('area_conhecimento_obra'),
          'Grande_Area_cod_grande_area'=>$grandeAreaObra->cod_grande_area,
        ]);


        if ($request->get('subarea_obra') != null) {
          $subareaObra = Subarea::firstOrCreate([
            'nome'=>$request->get('subarea_obra'),
            'Area_Conhecimento_cod_area_conhec'=>$areaConhecimentoObra->cod_area_conhec,
          ]);
        }

        if ($request->get('especialidade_obra') != null) {
          $especialidadeObra = Especialidade::firstOrCreate([
            'nome'=>$request->get('especialidade_obra'),
            'Subarea_cod_subarea'=>$subareaObra->cod_subarea,
          ]);
        }

        //Areas de conhecimento do autor
        $grandeAreaAutor = GrandeArea::firstOrCreate([
          'nome'=>$request->get('grande_area_autor'),
        ]);

        $areaConhecimentoAutor = AreaConhecimento::firstOrCreate([
          'nome'=>$request->get('area_conhecimento_autor'),
          'Grande_Area_cod_grande_area'=>$grandeAreaAutor->cod_grande_area,
        ]);

        if ($request->get('subarea_autor') != null) {
          $subareaAutor = Subarea::firstOrCreate([
            'nome'=>$request->get('subarea_autor'),
            'Area_Conhecimento_cod_area_conhec'=>$areaConhecimentoAutor->cod_area_conhec,
          ]);
        }

        $instituicao = Instituicao::firstOrCreate([
          'nome'=>$request->get('instituicao'),
        ]);

        if ($request->get('setor') != null) {
          $setor = Setor::firstOrCreate([
            'nome'=>$request->get('setor'),
            //falta sigla
            'Instituicao_cod_instituicao'=>$instituicao->cod_instituicao,
          ]);
        }

        if ($request->get('departamento') != null) {
          $departamento = Departamento::firstOrCreate([
            'nome'=>$request->get('departamento'),
            'Setor_cod_setor'=>$setor->cod_setor,
          ]);

        $autor = Autor::firstOrCreate([
          'categoria'=>$request->get('categoria'),
          'Departamento_cod_departamento'=>$departamento->cod_departamento,
          'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
        ]);
        }
        else{
          $autor = Autor::firstOrCreate([
            'categoria'=>$request->get('categoria'),
            'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
          ]);
        }

        if ($request->get('especialidade_autor') != null) {
          $especialidadeAutor = Especialidade::firstOrCreate([
            'nome'=>$request->get('especialidade_autor'),
            'Subarea_cod_subarea'=>$subareaAutor->cod_subarea,
          ]);
        }


        //TODO: Inserir um array de autores.
/*
        AutorEspecialidade::firstOrCreate([
          'Autor_cod_autor'=>$autor->cod_autor,
          'Especialidade_cod_especialidade'=>$especialidadeAutor->cod_especialidade,
        ]);
*/
        $obra = Obra::create([
          'titulo'=>$request->get('titulo'),
          'subtitulo'=>$request->get('subtitulo'),
          'descricao'=>$request->get('descricao'),
          'resumo'=>$request->get('resumo'),
          'Proposta_cod_proposta'=>$proposta->cod_proposta,
          'Autor_cod_autor'=>$autor->cod_autor,
        ]);


        //TODO: Criar Model e migration de ObraGrandeArea.
/*

        ObraGrandeArea::firstOrCreate([
          'Obra_cod_obra'=>$obra->cod_obra,
          'Grande_Area_cod_grande_area'=>$grandeAreaObra->cod_grande_area,
        ]);
*/
        $docpathident = Storage::putFile('documentos', $request->file('documento_c_identificacao'), 'private');
        $docpathnaoident = Storage::putFile('documentos', $request->file('documento_s_identificacao'), 'private');

        //$imgpath = Storage::putFile('imagens', $request->file('imagens'), 'public');

        Material::create([
          'url_documento'=>$docpathident,
          'url_documento_nao_ident'=>$docpathnaoident,
          //'url_imagens'=>$url_imagens,
          'Obra_cod_obra'=>$obra->cod_obra,
        ]);

        Telefone::create([
          'numero'=>$request->get('telefone'),
          'tipo'=>'1',
          'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
        ]);

        Email::create([
          'endereco'=>$request->get('email'),
          'tipo'=>'1',
          'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
        ]);


        $admin = User::join('Usuario_Adm', 'Usuario.cod_usuario', '=', 'Usuario_Adm.Usuario_cod_usuario')
                             ->get();

        Notification::send($admin->all(), new PropostaEnviada($proposta));

        return redirect('/enviar-proposta')->with('status', 'Proposta enviada! Sua identificação única é '.$proposta->cod_proposta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $usuario = Auth::user()->getAttributes();
        $idUsuario = $usuario['cod_usuario'];

        $propositor = DB::table('Usuario_Propositor')->join('Usuario', 'Usuario.cod_usuario', '=', 'Usuario_Propositor.Usuario_cod_usuario')
                              ->where('Usuario.cod_usuario', $idUsuario)
                              ->select('Usuario_Propositor.cod_propositor')
                              ->first();

        if(($proposta = Proposta::where('cod_proposta', '=', $id)->select('Proposta.*')->first()) != null){
          if(!$proposta->Usuario_Propositor_cod_propositor || $proposta->Usuario_Propositor_cod_propositor != $propositor->cod_propositor){
            abort(404);
          }
        }
        else {
          abort(404);
        }

        $obra = Obra::where('Proposta_cod_proposta', '=', $proposta->cod_proposta)->first();

        $autores = Pessoa::join('Autor', 'Pessoa.cod_pessoa', '=', 'Autor.Pessoa_cod_pessoa')
                   ->join('Obra', 'Obra.Autor_cod_autor', '=', 'Autor.cod_autor')
                   ->where('cod_obra', $obra->cod_obra)
                   ->select('Pessoa.*')
                   ->get();

        //TODO: EXCLUIR PALAVRAS CHAVE
        $palavrasChave = DB::table('Palavras_Chave')
                    ->join('Obra_Palavras_Chave', 'Obra_Palavras_Chave.Palavras_Chave_cod_pchave', '=', 'Palavras_Chave.cod_pchave')
                    ->join('Obra', 'Obra_Palavras_Chave.Obra_cod_obra', '=', 'Obra.cod_obra')
                    ->where('cod_obra', $obra->cod_obra)
                    ->select('Palavras_Chave.palavra')
                    ->get();

        $materiais = Material::join('Obra', 'Material.Obra_cod_obra', '=', 'Obra.cod_obra')
                    ->where('cod_obra', $obra->cod_obra)
                    ->select('Material.*')
                    ->get();

        return view('propostas.show', compact('obra', 'autores', 'palavrasChave', 'materiais', 'proposta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $usuario = Auth::user()->getAttributes();
      $idUsuario = $usuario['cod_usuario'];

      $propositor = DB::table('Usuario_Propositor')->join('Usuario', 'Usuario.cod_usuario', '=', 'Usuario_Propositor.Usuario_cod_usuario')
                            ->where('Usuario.cod_usuario', $idUsuario)
                            ->select('Usuario_Propositor.cod_propositor')
                            ->first();

      if(($proposta = Proposta::where('cod_proposta', '=', $id)->select('Proposta.*')->first()) != null){
        $propostaAttributes = $proposta->getAttributes();
        if(!$propostaAttributes['Usuario_Propositor_cod_propositor'] || $propostaAttributes['Usuario_Propositor_cod_propositor'] != $propositor->cod_propositor){
          abort(404);
        }
      }
      else {
        abort(404);
      }

      $obra = DB::table('Obra')->where('Proposta_cod_proposta', $id)->first();

      $autores = DB::table('Pessoa')
                  ->join('Autor', 'Pessoa.cod_pessoa', '=', 'Autor.Pessoa_cod_pessoa')
                  ->join('Obra', 'Obra.Autor_cod_autor', '=', 'Autor.cod_autor')
                  ->where('Proposta_cod_proposta', $id)
                  ->select('Pessoa.*')
                  ->get();


      $palavrasChave = DB::table('Palavras_Chave')
                  ->join('Obra_Palavras_Chave', 'Obra_Palavras_Chave.Palavras_Chave_cod_pchave', '=', 'Palavras_Chave.cod_pchave')
                  ->join('Obra', 'Obra_Palavras_Chave.Obra_cod_obra', '=', 'Obra.cod_obra')
                  ->where('Proposta_cod_proposta', $id)
                  ->select('Palavras_Chave.palavra')
                  ->get();

      return view('propostas.edit', compact('obra', 'autores', 'palavrasChave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropostaEditFormRequest $request, $id)
    {
        DB::table('Obra')->where('Proposta_cod_proposta', $id)->update([
          'titulo' => $request->get('titulo'),
          'subtitulo' => $request->get('subtitulo'),
          'descricao' => $request->get('descricao'),
          'resumo' => $request->get('resumo'),
          //ADICIONAR OUTROS CAMPOS
        ]);

        DB::table('Palavras_Chave')->where('Proposta_cod_proposta', $id)
          ->join('Obra_Palavras_Chave', 'Obra_Palavras_Chave.Palavras_Chave_cod_pchave', '=', 'Palavras_Chave.cod_pchave')
          ->join('Obra', 'Obra_Palavras_Chave.Obra_cod_obra', '=', 'Obra.cod_obra')
          ->update([
            'palavra' => $request->get('palavra'),
          ]);

        //TODO: Atualizar um array de autores.

        return redirect(action('PropostasController@show', $id))->with('status', 'A proposta '.$id.' foi atualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function solicitarCancelamento(CancelamentoFormRequest $request, $id)
    {

        $admin = User::join('Usuario_Adm', 'Usuario.cod_usuario', '=', 'Usuario_Adm.Usuario_cod_usuario')
                             ->get();

        Notification::send($admin->all(), new CancelamentoSolicitado($id, $request->get('justificativa')));

        return redirect()->back()->with('status', 'Sua solicitação foi enviada. Aguarde até que o administrador cancele sua proposta.');
    }
}

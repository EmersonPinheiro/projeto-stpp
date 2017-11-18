<?php

namespace App\Http\Controllers;

use App\Pais;
use App\EstadoProvincia;
use App\Cidade;
use App\Role;
use App\Permission;
use App\User;
use App\Obra;
use App\ObraAutor;
use App\Proposta;
use App\Autor;
use App\Pessoa;
use App\Instituicao;
use App\VinculoInstitucional;
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
use App\DocSugestaoAlteracoes;
use App\OficioAlteracoes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PropostaFormRequest;
use App\Http\Requests\PropostaEditFormRequest;
use App\Http\Requests\CancelamentoFormRequest;
use App\Http\Requests\MaterialVersionFormRequest;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PropostaEnviada;
use App\Notifications\CancelamentoSolicitado;
use App\Notifications\NovaVersaoObraEnviada;
use App\Notifications\PropostaEditada;

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
                        ->select('Obra.titulo', 'Obra.subtitulo', 'Obra.genese_relevancia', 'Obra.cod_obra', 'Proposta.data_envio', 'Proposta.cod_proposta', 'Proposta.situacao')
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

        $sexos = ['F', 'M'];

        return view('propostas.create', compact('autor', 'sexos'));
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

        $propositor = UsuarioPropositor::join('Usuario', 'Usuario.cod_usuario', '=', 'Usuario_Propositor.Usuario_cod_usuario')
                              ->where('Usuario.cod_usuario', $usuario->cod_usuario)
                              ->select('Usuario_Propositor.cod_propositor')
                              ->first();

        $proposta = Proposta::create([
          'data_envio'=>Carbon::now('America/Sao_Paulo')->format('Y-m-d'),
          'Usuario_Propositor_cod_propositor'=>$propositor->cod_propositor,
        ]);

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

        $obra = Obra::create([
          'titulo'=>$request->get('titulo'),
          'subtitulo'=>$request->get('subtitulo'),
          'resumo'=>$request->get('resumo'),
          'genese_relevancia'=>$request->get('genese_relevancia'),
          'Proposta_cod_proposta'=>$proposta->cod_proposta,
          'Grande_Area_cod_grande_area'=>$grandeAreaObra->cod_grande_area,
        ]);

        //TODO: Inserir um array de autores.

        if (!$pessoa = Pessoa::where('cpf', '=', $request->get('cpf'))->first()) {  // Verifica cpf duplicado.
          $pessoa = Pessoa::create([
            'cpf'=>$request->get('cpf'),
            'rg'=>$request->get('rg'),
            'nome'=>$request->get('nome'),
            'sobrenome'=>$request->get('sobrenome'),
            'sexo'=>$request->get('sexo'),
            'estado_civil'=>$request->get('estado_civil'),
            'logradouro'=>$request->get('logradouro'),
            'bairro'=>$request->get('bairro'),
            'CEP'=>$request->get('cep'),
          ]);
        }

        $instituicao = Instituicao::firstOrCreate([
          'nome'=>$request->get('instituicao'),
          'sigla'=>$request->get('sigla'),
        ]);

        if ($request->get('vinculo') != null) {
          $vinculo = VinculoInstitucional::firstOrCreate([
            'nome'=>$request->get('vinculo'),
            'Instituicao_cod_instituicao'=>$instituicao->cod_instituicao,
          ]);

        $autor = Autor::firstOrCreate([
          'categoria'=>$request->get('categoria'),
          'Instituicao_cod_instituicao'=>$instituicao->cod_instituicao,
          'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
        ]);
        }
        else{
          $autor = Autor::firstOrCreate([
            'categoria'=>$request->get('categoria'),
            'Instituicao_cod_instituicao'=>$instituicao->cod_instituicao,
            'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
          ]);
        }

        ObraAutor::create([
          'Obra_cod_obra'=>$obra->cod_obra,
          'Autor_cod_autor'=>$autor->cod_autor,
        ]);

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

        if ($request->get('telefeone_secundario') != null) {
          Telefone::create([
            'numero'=>$request->get('telefeone_secundario'),
            'tipo'=>'2',
            'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
          ]);
        }

        Email::create([
          'endereco'=>$request->get('email'),
          'tipo'=>'1',
          'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
        ]);

        if ($request->get('email_secundario') != null) {
          Email::create([
            'endereco'=>$request->get('email_secundario'),
            'tipo'=>'2',
            'Pessoa_cod_pessoa'=>$pessoa->cod_pessoa,
          ]);
        }


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

        $obra = Obra::join('Grande_Area', 'Grande_Area.cod_grande_area', 'Obra.Grande_Area_cod_grande_area')
                    ->join('Area_Conhecimento', 'Area_Conhecimento.Grande_Area_cod_grande_area', 'Grande_Area.cod_grande_area')
                    ->leftJoin('Subarea', 'Subarea.Area_Conhecimento_cod_area_conhec', 'Area_Conhecimento.cod_area_conhec')
                    ->leftJoin('Especialidade', 'Especialidade.Subarea_cod_subarea', 'Subarea.cod_subarea')
                    ->where('Proposta_cod_proposta', $proposta->cod_proposta)
                    ->select('Obra.*', 'Grande_Area.nome as grande_area_obra', 'Area_Conhecimento.nome as area_conhecimento_obra', 'Subarea.nome as subarea_obra', 'Especialidade.nome as especialidade_obra')
                    ->first();

        $autores = Pessoa::join('Autor', 'Pessoa.cod_pessoa', '=', 'Autor.Pessoa_cod_pessoa')
                   ->join('Obra_Autor', 'Autor.cod_autor', 'Obra_Autor.Autor_cod_autor')
                   ->join('Obra', 'Obra.cod_obra', '=', 'Obra_Autor.Obra_cod_obra')
                   ->where('Obra.cod_obra', $obra->cod_obra)
                   ->select('Pessoa.*')
                   ->get();


        $materiais = Material::join('Obra', 'Material.Obra_cod_obra', '=', 'Obra.cod_obra')
                  ->where('cod_obra', $obra->cod_obra)
                  ->select('Material.*')
                  ->get();

        $docsSugestoes = DocSugestaoAlteracoes::where('Proposta_cod_proposta', '=', $proposta->cod_proposta)->get();
        $oficiosAlteracoes = OficioAlteracoes::where('Proposta_cod_proposta', '=', $proposta->cod_proposta)->get();

        return view('propostas.show', compact('obra', 'autores', 'palavrasChave', 'materiais', 'proposta', 'docsSugestoes', 'oficiosAlteracoes'));
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

      $obra = Obra::join('Grande_Area', 'Grande_Area.cod_grande_area', 'Obra.Grande_Area_cod_grande_area')
                  ->join('Area_Conhecimento', 'Area_Conhecimento.Grande_Area_cod_grande_area', 'Grande_Area.cod_grande_area')
                  ->leftJoin('Subarea', 'Subarea.Area_Conhecimento_cod_area_conhec', 'Area_Conhecimento.cod_area_conhec')
                  ->leftJoin('Especialidade', 'Especialidade.Subarea_cod_subarea', 'Subarea.cod_subarea')
                  ->select('Obra.*', 'Grande_Area.nome as grande_area_obra', 'Area_Conhecimento.nome as area_conhecimento_obra', 'Subarea.nome as subarea_obra', 'Especialidade.nome as especialidade_obra')
                  ->where('Proposta_cod_proposta', $id)
                  ->first();

      $autores = Pessoa::join('Autor', 'Pessoa.cod_pessoa', '=', 'Autor.Pessoa_cod_pessoa')
                 ->join('Obra_Autor', 'Obra_Autor.Autor_cod_autor', 'Autor.cod_autor')
                 ->join('Obra', 'Obra.cod_obra', '=', 'Obra_Autor.Obra_cod_obra')
                 ->join('Instituicao', 'Autor.Instituicao_cod_instituicao', 'Instituicao.cod_instituicao')
                 ->leftJoin('Vinculo_Institucional', 'Vinculo_Institucional.Instituicao_cod_instituicao', 'Instituicao.cod_instituicao')
                 ->where('Obra.cod_obra', $obra->cod_obra)
                 ->select('Pessoa.*', 'Autor.*', 'Instituicao.nome as nome_instituicao', 'Vinculo_Institucional.nome as nome_vinculo', 'Instituicao.sigla')
                 ->get();

      return view('propostas.edit', compact('obra', 'autores'));
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
        if (($proposta = Proposta::where('cod_proposta', '=', $id)->first()) == null) {
          abort(404);
        }

        Obra::where('Proposta_cod_proposta', $proposta->cod_proposta)->update([
          'titulo' => $request->get('titulo'),
          'subtitulo' => $request->get('subtitulo'),
          'resumo' => $request->get('resumo'),
          'genese_relevancia' => $request->get('genese_relevancia'),
          //ADICIONAR OUTROS CAMPOS
        ]);

        GrandeArea::where('cod_grande_area', '=', $request->get('cod_grande_area'))
          ->update([
            'nome'=>$request->get('grande_area_obra'),
          ]);

        AreaConhecimento::where('cod_area_conhec', '=', $request->get('cod_area_conhec'))
          ->update([
            'nome'=>$request->get('area_conhecimento_obra'),
          ]);

        if ($request->get('subarea_obra') != null) {
          Subarea::where('cod_subarea', '=', $request->get('cod_subarea'))
            ->update([
              'nome'=>$request->get('subarea_obra'),
            ]);
        }

        if ($request->get('especialidade_obra') != null) {
          Especialidade::where('cod_especialidade', '=', $request->get('cod_especialidade'))
            ->update([
              'nome'=>$request->get('especialidade_obra'),
            ]);
        }

        $admin = User::join('Usuario_Adm', 'Usuario.cod_usuario', '=', 'Usuario_Adm.Usuario_cod_usuario')
                             ->get();

        Notification::send($admin->all(), new PropostaEditada($proposta));


        //TODO: Atualizar um array de autores.

        return redirect(action('PropostasController@show', $id))->with('status', 'Sua proposta foi atualizada!');
    }

    public function solicitarCancelamento(CancelamentoFormRequest $request, $id)
    {

        $admin = User::join('Usuario_Adm', 'Usuario.cod_usuario', '=', 'Usuario_Adm.Usuario_cod_usuario')
                             ->get();

        Notification::send($admin->all(), new CancelamentoSolicitado($id, $request->get('justificativa')));

        return redirect()->back()->with('status', 'Sua solicitação foi enviada. Aguarde até que o administrador cancele sua proposta.');
    }

    public function novaVersaoObra(MaterialVersionFormRequest $request)
    {
      if (($proposta = Proposta::where('cod_proposta', '=', $request->get('cod_proposta'))->first()) == null) {
        abort(404);
      }

      $docpathident = Storage::putFile('documentos', $request->file('novo_documento_identificado'), 'private');
      $docpathnaoident = Storage::putFile('documentos', $request->file('novo_documento_nao_identificado'), 'private');
      $ofcpath = Storage::putFile('oficios-de-alteracao', $request->file('oficio'), 'private');

      $versaoMaterial = DB::table('Material')
        ->join('Obra', 'Material.Obra_cod_obra', '=', 'Obra.cod_obra')
        ->where('cod_obra', $request->get('cod_obra'))
        ->max('Material.versao');

      DB::table('Material')
        ->join('Obra', 'Material.Obra_cod_obra', '=', 'Obra.cod_obra')
        ->where('cod_obra', $request->get('cod_obra'))
        ->insert([
          'versao'=>$versaoMaterial + 1,
          'url_documento'=>$docpathident,
          'url_documento_nao_ident'=>$docpathnaoident,
          'Obra_cod_obra'=>$request->get('cod_obra'),
      ]);

      if (($versaoOficio = OficioAlteracoes::where('Proposta_cod_proposta', '=', $proposta->cod_proposta)->max('versao')) == null) {
        $versaoOficio = 0;
      }

      $oficio = OficioAlteracoes::create([
        'url_documento'=>$ofcpath,
        'versao'=>$versaoOficio + 1,
        'Proposta_cod_proposta'=>$request->get('cod_proposta'),
      ]);

      $admin = User::join('Usuario_Adm', 'Usuario.cod_usuario', '=', 'Usuario_Adm.Usuario_cod_usuario')
                           ->get();

      Notification::send($admin->all(), new NovaVersaoObraEnviada($proposta));

      return redirect(action('PropostasController@show', $request->cod_proposta))->with('status', 'A nova versão da obra foi enviada!');

    }

}

<?php

namespace App\Http\Controllers;

use App\User;
use App\Proposta;
use App\Obra;
use App\Autor;
use App\Material;
use App\Pessoa;
use App\Parecer;
use App\DocSugestaoAlteracoes;
use App\OficioAlteracoes;
use Illuminate\Http\Request;
use App\Http\Requests\PropostaEditFormRequest;
use App\Http\Requests\SolicitarNovaVersaoFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NovaVersaoSolicitada;
use App\Notifications\PropostaCancelada;
use App\Notifications\SituacaoAlterada;

class AdminController extends Controller
{
  public function __construct()
  {
    if (!Auth::check()) {
      return redirect('/');
    }

    $admin = Auth::user();
    if (!$admin->hasRole('admin')) {
      abort(404);
    }

  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::user();

        $propostas = Proposta::join('Obra', 'Obra.Proposta_cod_proposta', '=', 'Proposta.cod_proposta')->get();

        return view('admin.painel-administrador', compact('propostas', 'admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (($proposta = Proposta::where('cod_proposta', '=', $id)->first()) == null) {
          abort(404);
        }
/*
        $propositor = UsuarioPropositor::join('Proposta', 'Proposta.Usuario_Propositor_cod_propositor', '=', 'cod_propositor')
                    ->where('Proposta.cod_proposta', '=', $proposta->cod_proposta)
                    ->select('Usuario_Propositor.*')
                    ->first();
*/


        $obra = Obra::where('Proposta_cod_proposta', '=', $proposta->cod_proposta)->first();

        $autores = Pessoa::join('Autor', 'Pessoa.cod_pessoa', '=', 'Autor.Pessoa_cod_pessoa')
                   ->join('Obra_Autor', 'Autor.cod_autor', 'Obra_Autor.Autor_cod_autor')
                   ->join('Obra', 'Obra.cod_obra', '=', 'Obra_Autor.Obra_cod_obra')
                   ->where('Obra.cod_obra', $obra->cod_obra)
                   ->select('Pessoa.*')
                   ->get();
/*
        $pareceristasPareceres = Pessoa::join('Usuario', 'Pessoa.cod_pessoa', '=', 'Usuario.Pessoa_cod_pessoa')
                   ->join('Usuario_Parecerista', 'Usuario.cod_usuario', '=', 'Usuario_Parecerista.Usuario_cod_usuario')
                   ->join('Parecer', 'Usuario_Parecerista.cod_parecerista', '=', 'Parecer.Usuario_Parecerista_cod_parecerista')
                   ->join('Proposta', 'Proposta.cod_proposta', 'Parecer.Proposta_cod_proposta')
                   ->where('cod_proposta', $proposta->cod_proposta)
                   ->select('Pessoa.*', 'Parecer.*')
                   ->get();
*/
        $pareceristasPareceres = Parecer::join('Usuario_Parecerista', 'Usuario_Parecerista.cod_parecerista', '=', 'Parecer.Usuario_Parecerista_cod_parecerista')
                  ->join('Usuario', 'Usuario.cod_usuario', '=', 'Usuario_Parecerista.Usuario_cod_usuario')
                  ->join('Pessoa', 'Pessoa.cod_pessoa', '=', 'Usuario.Pessoa_cod_pessoa')
                  ->join('Proposta', 'Proposta.cod_proposta', 'Parecer.Proposta_cod_proposta')
                  ->where('cod_proposta', $proposta->cod_proposta)
                  ->select('Pessoa.*', 'Parecer.*')
                  ->get();

        $materiais = Material::join('Obra', 'Material.Obra_cod_obra', '=', 'Obra.cod_obra')
                  ->where('cod_obra', $obra->cod_obra)
                  ->select('Material.*')
                  ->get();

        $tecnicos = Pessoa::join('Tecnico_Catalografia', 'Tecnico_Catalografia.Pessoa_cod_pessoa', '=', 'Pessoa.cod_pessoa')
                  ->join('Obra_Tecnico_Catalografia', 'Obra_Tecnico_Catalografia.Tecnico_Catalografia_cod_tec_catalog', '=', 'Tecnico_Catalografia.cod_tec_catalog')
                  ->join('Obra', 'Obra_Tecnico_Catalografia.Obra_cod_obra', '=', 'Obra.cod_obra')
                  ->where('Obra.cod_obra', '=', $obra->cod_obra)
                  ->get();

        $funcoes = array(
          'revisor_ortografico' => $tecnicos->where('funcao', '1')->first(),
          'revisor_ingles' => $tecnicos->where('funcao', '2')->first(),
          'revisor_espanhol' => $tecnicos->where('funcao', '3')->first(),
          'criador_capa' => $tecnicos->where('funcao', '4')->first(),
          'diagramador' => $tecnicos->where('funcao', '5')->first(),
          'coordenacao_editorial' => $tecnicos->where('funcao', '6')->first(),
          'projetista_grafico' => $tecnicos->where('funcao', '7')->first(),
        );

        $docsSugestoes = DocSugestaoAlteracoes::where('Proposta_cod_proposta', '=', $proposta->cod_proposta)->get();
        $oficiosAlteracoes = OficioAlteracoes::where('Proposta_cod_proposta', '=', $proposta->cod_proposta)->get();

        return view('admin.show-proposta', compact('proposta', 'obra', 'autores', 'pareceristasPareceres', 'materiais', 'funcoes', 'docsSugestoes', 'oficiosAlteracoes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (($proposta = Proposta::where('cod_proposta', '=', $id)->first()) == null) {
        abort(404);
      }

      $obra = Obra::where('Proposta_cod_proposta', '=', $proposta->cod_proposta)->first();

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

      $tecnicos = Pessoa::join('Tecnico_Catalografia', 'Tecnico_Catalografia.Pessoa_cod_pessoa', '=', 'Pessoa.cod_pessoa')
                  ->join('Obra_Tecnico_Catalografia', 'Obra_Tecnico_Catalografia.Tecnico_Catalografia_cod_tec_catalog', '=', 'Tecnico_Catalografia.cod_tec_catalog')
                  ->join('Obra', 'Obra_Tecnico_Catalografia.Obra_cod_obra', '=', 'Obra.cod_obra')
                  ->where('Obra.cod_obra', '=', $obra->cod_obra)
                  ->get();

      $funcoes = array(
        'revisor_ortografico' => $tecnicos->where('funcao', '1')->first(),
        'revisor_ingles' => $tecnicos->where('funcao', '2')->first(),
        'revisor_espanhol' => $tecnicos->where('funcao', '3')->first(),
        'cricador_capa' => $tecnicos->where('funcao', '4')->first(),
        'diagramador' => $tecnicos->where('funcao', '5')->first(),
        'coordenacao_editorial' => $tecnicos->where('funcao', '6')->first(),
        'projetista_grafico' => $tecnicos->where('funcao', '7')->first(),
      );

      $situacoes = ['Submetida', 'Em avaliação', 'Aguardando parecer', 'Aguardando decisão do Conselho Editorial', 'Em trâmite', 'Finalizada'];

      return view('admin.edit-proposta', compact('obra', 'autores', 'palavrasChave', 'materiais', 'funcoes', 'situacoes'));
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

      $obra = Obra::where('Proposta_cod_proposta', '=', $proposta->cod_proposta)
                  ->update([
                    'titulo'=>$request->get('titulo'),
                    'subtitulo'=>$request->get('subtitulo'),
                    'genese_relevancia'=>$request->get('genese_relevancia'),
                    'resumo'=>$request->get('resumo'),
                    'volume'=>$request->get('volume'),
                    'ano_publicacao'=>$request->get('ano'),
                    'num_paginas'=>$request->get('num_paginas'),
                  ]);

      if ($proposta->situacao != $request->get('situacao')) {
        $proposta->situacao = $request->get('situacao');
        $proposta->save();

        $usuario = User::join('Usuario_Propositor', 'Usuario.cod_usuario', '=', 'Usuario_Propositor.Usuario_cod_usuario')
                       ->join('Proposta', 'Proposta.Usuario_Propositor_cod_propositor', 'Usuario_Propositor.cod_propositor')
                       ->where('cod_proposta', '=', $proposta->cod_proposta)
                       ->select('Usuario.*')
                       ->first();

        Notification::send($usuario, new SituacaoAlterada($proposta));
      }

      //TODO: Atualizar um array de autores/tecnicos.

      return redirect(action('AdminController@show', $id))->with('status', 'A proposta '.$id.' foi atualizada!');

    }

    public function cancelarProposta($id)
    {

      if (($proposta = Proposta::where('cod_proposta', '=', $id)->first()) == null) {
        abort(404);
      }

      $propositor = User::join('Usuario_Propositor', 'Usuario.cod_usuario', '=', 'Usuario_Propositor.Usuario_cod_usuario')
                        ->where('cod_propositor', '=', $proposta->Usuario_Propositor_cod_propositor)
                        ->select('Usuario.*')
                        ->first();

      $proposta->situacao = 'Cancelada';
      $proposta->save();

      Notification::send($propositor, new PropostaCancelada($proposta));

      return redirect('/admin/painel-administrador')->with('status', 'A proposta foi cancelada com sucesso.');
    }

    public function solicitarNovaVersao(SolicitarNovaVersaoFormRequest $request, $id)
    {
      $proposta = Proposta::where('cod_proposta', '=', $id)->first();

      $propositor = User::join('Usuario_Propositor', 'Usuario.cod_usuario', '=', 'Usuario_Propositor.Usuario_cod_usuario')
                        ->where('cod_propositor', '=', $proposta->Usuario_Propositor_cod_propositor)
                        ->select('Usuario.*')
                        ->first();

      $docpath = Storage::putFile('documentos_sugestao_alteracao', $request->file('doc_sugestao'), 'private');

      if (($versaoDocSugestao = DocSugestaoAlteracoes::where('Proposta_cod_proposta', '=', $proposta->cod_proposta)->max('versao')) == null) {
        $versaoOficio = 0;
      }

      $docSugestao = DocSugestaoAlteracoes::create([
          'url_documento'=>$docpath,
          'versao'=>$versaoOficio + 1,
          'Proposta_cod_proposta'=>$proposta->cod_proposta,
      ]);

      Notification::send($propositor, new NovaVersaoSolicitada($proposta));

      return redirect()->back()->with('status', 'Sua solicitação foi enviada! Aguarde até que o propositor submeta uma nova versão da proposta.');

    }
  }

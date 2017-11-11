<?php

namespace App\Http\Controllers;

use App\Proposta;
use App\Obra;
use App\Autor;
use App\Material;
use App\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
        if (!Auth::user()->hasRole('admin')) {
          abort(404);
        }
        $propostas = Proposta::join('Obra', 'Obra.Proposta_cod_proposta', '=', 'Proposta.cod_proposta')->get();

        return view('admin.painel-administrador', compact('propostas'));
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
        $proposta = Proposta::where('cod_proposta', '=', $id)->select('Proposta.*')->first();

        if (!Auth::user()->hasRole('admin') || $proposta == null) {
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

        return view('admin.show-proposta', compact('proposta', 'obra', 'autores', 'palavrasChave', 'materiais', 'funcoes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

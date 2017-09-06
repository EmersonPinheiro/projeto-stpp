<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PropostaFormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PropostasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('propostas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropostaFormRequest $request)
    {
      //DB::transaction(function(){

        $idProposta = DB::table('Proposta')->insertGetID([
          'data_envio'=>Carbon::now('America/Sao_Paulo')->format('Y-m-d'),
        ]);
/*
        //VERIFICA A EXISTÊNCIA DO PAÍS INSERIDO
        $query = DB::table('Pais')->select('cod_pais')->where('nome', $request->get('pais'))->get();
        if (!$query) {


          //VERIFICA A EXISTÊNCIA DO ESTADO INSERIDO
          $query = DB::table('Estado_provincia')->select('cod_est_prov')->where('nome', $request->get('estado'))->get();
          if (!$query) {


           //VERIFICA A EXISTÊNCIA DA CIDADE INSERIDA
           $query = DB::table('Cidade')->select('cod_cidade')->where('nome', $request->get('cidade'))->get();
           if (!$query) {
           }
          }
        }*/

        $idPais = DB::table('Pais')->insertGetID([
          'nome'=>$request->get('pais'),
        ]);

        $idEstProv = DB::table('Estado_provincia')->insertGetID([
         'nome'=>$request->get('estado'),
         //falta uf
         'Pais_cod_pais'=>$idPais,
        ]);

         $idCidade = DB::table('Cidade')->insertGetID([
          'nome'=>$request->get('cidade'),
          'Estado_provincia_cod_est_prov'=>$idEstProv,
        ]);

        $idPessoa = DB::table('Pessoa')->insertGetID([
          'cpf'=>$request->get('CPF'),
          'nome'=>$request->get('nome'),
          'sobrenome'=>$request->get('sobrenome'),
          'sexo'=>$request->get('sexo'),
          'Cidade_cod_cidade'=>$idCidade,
        ]);

        $idInstituicao = DB::table('Instituicao')->insertGetID([
          'nome'=>$request->get('instituicao'),
        ]);

        $idSetor = DB::table('Setor')->insertGetID([
          'nome'=>$request->get('setor'),
          //falta sigla
          'Instituicao_cod_instituicao'=>$idInstituicao,
        ]);

        $idDepartamento = DB::table('Departamento')->insertGetID([
          'nome'=>$request->get('departamento'),
          'Setor_cod_setor'=>$idSetor,
        ]);

        $idGrandeArea = DB::table('Grande_Area')->insertGetID([
          'nome'=>$request->get('grande_area'),
        ]);

        $idAreaConhecimento = DB::table('Area_Conhecimento')->insertGetID([
          'nome'=>$request->get('area_conhecimento'),
          'Grande_Area_cod_grande_area'=>$idGrandeArea,
        ]);

        $idSubarea = DB::table('Subarea')->insertGetID([
          'nome'=>$request->get('subarea'),
          'Area_Conhecimento_cod_area_conhec'=>$idAreaConhecimento,
        ]);

        $idEspecialidade = DB::table('Especialidade')->insertGetID([
          'nome'=>$request->get('especialidade'),
          'Subarea_cod_subarea'=>$idSubarea,
        ]);

        $idAutor = DB::table('Autor')->insertGetID([
          'categoria'=>'1',
          //'categoria'=>$request->get('categoria'),
          'Departamento_cod_departamento'=>$idDepartamento,
          'Pessoa_cod_pessoa'=>$idPessoa,
        ]);

        DB::table('Autor_Especialidade')->insert([
          'Autor_cod_autor'=>$idAutor,
          'Especialidade_cod_especialidade'=>$idEspecialidade,
        ]);

        $idObra = DB::table('Obra')->insertGetID([
          'titulo'=>$request->get('titulo'),
          'subtitulo'=>$request->get('subtitulo'),
          'descricao'=>$request->get('descricao'),
          'resumo'=>$request->get('resumo'),
          'Proposta_cod_proposta'=>$idProposta,
          'Autor_cod_autor'=>$idAutor,
        ]);

        $idPalavraChave = DB::table('Palavras_Chave')->insertGetID([
          'palavra'=>$request->get('palavras_chave'),
        ]);

        DB::table('Obra_Palavras_Chave')->insert([
          'Obra_cod_obra'=>$idObra,
          'Palavras_Chave_cod_pchave'=>$idPalavraChave,
        ]);

        DB::table('Telefone')->insert([
          'numero'=>$request->get('telefone'),
          'tipo'=>'1',
          'Pessoa_cod_pessoa'=>$idPessoa,
        ]);

        DB::table('Email')->insert([
          'endereco'=>$request->get('email'),
          'tipo'=>'1',
          'Pessoa_cod_pessoa'=>$idPessoa,
        ]);

        return redirect('/enviar-proposta')->with('status', 'Proposta enviada! Sua identificação única é '.$idProposta);
          //return $request->all();
    // });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

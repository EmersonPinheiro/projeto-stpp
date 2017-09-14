<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PropostaFormRequest;
use App\Http\Requests\PropostaEditFormRequest;

class PropostasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //CRIAR FUNÇÃO QUE VERIFICA O USUÁRIO LOGADO
      $propostas = DB::table('Obra')
                        ->join('Proposta', 'Obra.Proposta_cod_proposta', '=', 'Proposta.cod_proposta')
                        ->select('Obra.titulo', 'Obra.subtitulo', 'Obra.descricao', 'Obra.cod_obra', 'Proposta.data_envio')
                        ->get();
      return view('painel', compact('propostas'));
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

        /*$idPropositor = DB::table('Usuario_propositor')->insertGetID([

          //RECUPERAR O USUÁRIO LOGADO

        ]);*/

        $idProposta = DB::table('Proposta')->insertGetID([
          'data_envio'=>Carbon::now('America/Sao_Paulo')->format('Y-m-d'),
          'Usuario_propositor_cod_propositor'=>'1',
        ]);

        //VERIFICAR INSERSÃO DE VALORES IGUAIS

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

        //UPLOAD DOS ARQUIVOS
/*
        $docpath = $request->file('documento')->store('docs');
        $file= storage_path()."/app/". $docpath;

        $headers = [
              'Content-Type' => 'application/pdf',
           ];

        return response()->file($file);
*/

        $docpath = Storage::putFile('documentos', $request->file('documento'), 'public');
        //$imgpath = Storage::putFile('imagens', $request->file('imagens'), 'public');
        $url_documento = Storage::url($docpath);
        //$url_imagens = Storage::url($imgpath);
        DB::table('Material')->insert([
          //'edicao'=>
          //'versao'=>
          'url_documento'=>$docpath,
          //'url_imagens'=>$url_imagens,
          'Obra_cod_obra'=>$idObra,
        ]);

        $idPalavraChave = DB::table('Palavras_Chave')->insertGetID([
          'palavra'=>$request->get('palavra'),
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $obra = DB::table('Obra')->where('cod_obra', $id)->first();

        $autores = DB::table('Pessoa')
                    ->join('Autor', 'Pessoa.cod_pessoa', '=', 'Autor.Pessoa_cod_pessoa')
                    ->join('Obra', 'Obra.Autor_cod_autor', '=', 'Autor.cod_autor')
                    ->where('cod_obra', $id)
                    ->select('Pessoa.*')
                    ->get();

        $palavrasChave = DB::table('Palavras_Chave')
                    ->join('Obra_Palavras_Chave', 'Obra_Palavras_Chave.Palavras_Chave_cod_pchave', '=', 'Palavras_Chave.cod_pchave')
                    ->join('Obra', 'Obra_Palavras_Chave.Obra_cod_obra', '=', 'Obra.cod_obra')
                    ->where('cod_obra', $id)
                    ->select('Palavras_Chave.palavra')
                    ->get();

        $material = DB::table('Material')
                    ->join('Obra', 'Material.Obra_cod_obra', '=', 'Obra.cod_obra')
                    ->where('cod_obra', $id)
                    ->select('Material.*')
                    ->first();

        return view('propostas.show', compact('obra', 'autores', 'palavrasChave', 'material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $obra = DB::table('Obra')->where('cod_obra', $id)->first();

      $autores = DB::table('Pessoa')
                  ->join('Autor', 'Pessoa.cod_pessoa', '=', 'Autor.Pessoa_cod_pessoa')
                  ->join('Obra', 'Obra.Autor_cod_autor', '=', 'Autor.cod_autor')
                  ->where('cod_obra', $id)
                  ->select('Pessoa.*')
                  ->get();


      $palavrasChave = DB::table('Palavras_Chave')
                  ->join('Obra_Palavras_Chave', 'Obra_Palavras_Chave.Palavras_Chave_cod_pchave', '=', 'Palavras_Chave.cod_pchave')
                  ->join('Obra', 'Obra_Palavras_Chave.Obra_cod_obra', '=', 'Obra.cod_obra')
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
        DB::table('Obra')->where('cod_obra', $id)->update([
          'titulo' => $request->get('titulo'),
          'subtitulo' => $request->get('subtitulo'),
          'descricao' => $request->get('descricao'),
          'resumo' => $request->get('resumo'),
        ]);

        DB::table('Palavras_Chave')->where('cod_obra', $id)
        ->join('Obra_Palavras_Chave', 'Obra_Palavras_Chave.Palavras_Chave_cod_pchave', '=', 'Palavras_Chave.cod_pchave')
        ->join('Obra', 'Obra_Palavras_Chave.Obra_cod_obra', '=', 'Obra.cod_obra')
        ->update([
          'palavra' => $request->get('palavra'),
        ]);
/*
        $autores = DB::table('Pessoa')
                    ->join('Autor', 'Pessoa.cod_pessoa', '=', 'Autor.Pessoa_cod_pessoa')
                    ->join('Obra', 'Obra.Autor_cod_autor', '=', 'Autor.cod_autor')
                    ->where('cod_obra', $id)
                    ->select('Pessoa.*')
                    ->get();
        $palavrasChave = DB::table('Palavras_Chave')
                    ->join('Obra_Palavras_Chave', 'Obra_Palavras_Chave.Palavras_Chave_cod_pchave', '=', 'Palavras_Chave.cod_pchave')
                    ->join('Obra', 'Obra_Palavras_Chave.Obra_cod_obra', '=', 'Obra.cod_obra')
                    ->select('Palavras_Chave.palavra')
                    ->get();*/

        return redirect(action('PropostasController@show', $id))->with('status', 'A proposta '.$id.' foi atualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //CRIAR FUNÇÃO DE PERMISSÃO
    }
}

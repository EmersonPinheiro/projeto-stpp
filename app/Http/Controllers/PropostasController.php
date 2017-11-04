<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\User;
use App\Obra;
use App\Proposta;
use App\Autor;
use App\Pessoa;
use App\Material;
use App\UsuarioPropositor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PropostaFormRequest;
use App\Http\Requests\PropostaEditFormRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\PropostaEnviada;

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
                        ->select('Obra.titulo', 'Obra.subtitulo', 'Obra.descricao', 'Obra.cod_obra', 'Proposta.data_envio', 'Proposta.cod_proposta')
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

        $usuario = Auth::user()->getAttributes();
        $idUsuario = $usuario['cod_usuario'];

        $propositor = DB::table('Usuario_Propositor')->join('Usuario', 'Usuario.cod_usuario', '=', 'Usuario_Propositor.Usuario_cod_usuario')
                              ->where('Usuario.cod_usuario', $idUsuario)
                              ->select('Usuario_Propositor.cod_propositor')
                              ->first();

        $idProposta = DB::table('Proposta')->insertGetID([
          'data_envio'=>Carbon::now('America/Sao_Paulo')->format('Y-m-d'),
          'Usuario_Propositor_cod_propositor'=>$propositor->cod_propositor,
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

        $docpath = Storage::putFile('documentos', $request->file('documento'), 'private');
        //$imgpath = Storage::putFile('imagens', $request->file('imagens'), 'public');
        $url_documento = Storage::url($docpath);
        //$url_imagens = Storage::url($imgpath);
        DB::table('Material')->insert([

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

        $emailAdmin = 'exemploadmin@email.com';
        Mail::to($emailAdmin)->send(new PropostaEnviada($request));

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

        $obra = Obra::where('Proposta_cod_proposta', '=', $id)->first();

        $autores = Pessoa::join('Autor', 'Pessoa.cod_pessoa', '=', 'Autor.Pessoa_cod_pessoa')
                   ->join('Obra', 'Obra.Autor_cod_autor', '=', 'Autor.cod_autor')
                   ->where('cod_obra', $id)
                   ->select('Pessoa.*')
                   ->get();

        //TODO: EXCLUIR PALAVRAS CHAVE
        $palavrasChave = DB::table('Palavras_Chave')
                    ->join('Obra_Palavras_Chave', 'Obra_Palavras_Chave.Palavras_Chave_cod_pchave', '=', 'Palavras_Chave.cod_pchave')
                    ->join('Obra', 'Obra_Palavras_Chave.Obra_cod_obra', '=', 'Obra.cod_obra')
                    ->where('cod_obra', $id)
                    ->select('Palavras_Chave.palavra')
                    ->get();

        $materiais = Material::join('Obra', 'Material.Obra_cod_obra', '=', 'Obra.cod_obra')
                    ->where('cod_obra', $id)
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

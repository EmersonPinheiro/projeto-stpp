<?php

namespace App\Http\Controllers;

use App\Pessoa;
use App\User;
use App\Instituicao;
use App\VinculoInstitucional;
use App\GrandeArea;
use App\AreaConhecimento;
use App\Subarea;
use App\Especialidade;
use App\Cidade;
use App\EstadoProvincia;
use App\Pais;
use App\Telefone;
use App\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\PerfilEditFormRequest;

class PerfilController extends Controller
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
    public function show($slug)
    {
      $pessoaUsuario = User::join('Pessoa', 'Usuario.Pessoa_cod_pessoa', '=', 'Pessoa.cod_pessoa')
          ->where('Pessoa.slug', '=', $slug)->first();

      $usuarioLogado = Auth::user();

      $localizacao = Cidade::join('Estado_provincia', 'Estado_provincia.cod_est_prov', '=', 'Cidade.Estado_provincia_cod_est_prov')
          ->join('Pais', 'Pais.cod_pais', '=', 'Estado_provincia.Pais_cod_pais')
          ->select('Pais.nome as nome_pais', 'Estado_provincia.nome as nome_estado_provincia', 'Cidade.nome as nome_cidade')
          ->where('cod_cidade', '=', $pessoaUsuario->Cidade_cod_cidade)->first();

      if ($pessoaUsuario->hasRole('admin') && $usuarioLogado->hasRole('admin')) {

        return view('perfil.perfil', compact('pessoaUsuario', 'localizacao', 'usuarioLogado'));
      }

      if($pessoaUsuario->hasRole('propositor')){
        $usuarioTipo = User::join('Usuario_Propositor', 'Usuario.cod_usuario', '=', 'Usuario_Propositor.Usuario_cod_usuario')
            ->where('Usuario.Pessoa_cod_pessoa', '=', $pessoaUsuario->cod_pessoa)->first();
      }

      if($pessoaUsuario->hasRole('parecerista')){
        $usuarioTipo = User::join('Usuario_Parecerista', 'Usuario.cod_usuario', '=', 'Usuario_Parecerista.Usuario_cod_usuario')
            ->where('Usuario.Pessoa_cod_pessoa', '=', $pessoaUsuario->cod_pessoa)->first();

        $areasConhecimento = GrandeArea::join('Area_Conhecimento', 'Area_Conhecimento.Grande_Area_cod_grande_area', 'Grande_Area.cod_grande_area')
          ->leftJoin('Subarea', 'Subarea.Area_Conhecimento_cod_area_conhec', 'Area_Conhecimento.cod_area_conhec')
          ->leftJoin('Especialidade', 'Especialidade.Subarea_cod_subarea', 'Subarea.cod_subarea')
          ->where('Grande_Area.cod_grande_area', '=', $usuarioTipo->Grande_Area_cod_grande_area)
          ->select('Grande_Area.nome as nome_grande_area', 'Area_Conhecimento.nome as nome_area_conhecimento', 'Subarea.nome as nome_subarea', 'Especialidade.nome as nome_especialidade')
          ->first();
          //var_dump($usuarioTipo);
        //var_dump($areasConhecimento);
      }

      $instituicaoVinculo = Instituicao::leftJoin('Vinculo_Institucional', 'Vinculo_Institucional.Instituicao_cod_instituicao', 'Instituicao.cod_instituicao')
        ->where('cod_instituicao', '=', $usuarioTipo->Instituicao_cod_instituicao)
        ->select('Instituicao.nome as nome_instituicao', 'Instituicao.sigla', 'Vinculo_Institucional.nome as nome_vinculo')
        ->first();

      $telefone = Telefone::join('Pessoa', 'Pessoa.cod_pessoa', '=','Telefone.Pessoa_cod_pessoa')
          ->where('Telefone.tipo', '=', 1)
          ->where('Pessoa.cod_pessoa', '=', $pessoaUsuario->cod_pessoa)
          ->select('Telefone.*')
          ->first();

      $email = Email::join('Pessoa', 'Pessoa.cod_pessoa', '=','Email.Pessoa_cod_pessoa')
          ->where('Email.tipo', '=', 1)
          ->where('Pessoa.cod_pessoa', '=', $pessoaUsuario->cod_pessoa)
          ->select('Email.*')
          ->first();

      return view('perfil.perfil', compact('pessoaUsuario', 'localizacao', 'instituicaoVinculo', 'telefone', 'email', 'usuarioTipo', 'usuarioLogado', 'areasConhecimento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
      $pessoaUsuario = User::join('Pessoa', 'Usuario.Pessoa_cod_pessoa', '=', 'Pessoa.cod_pessoa')
          ->where('Pessoa.slug', '=', $slug)->first();

      $usuarioLogado = Auth::user();

      $localizacao = Cidade::join('Estado_provincia', 'Estado_provincia.cod_est_prov', '=', 'Cidade.Estado_provincia_cod_est_prov')
          ->join('Pais', 'Pais.cod_pais', '=', 'Estado_provincia.Pais_cod_pais')
          ->select('Pais.nome as nome_pais', 'Estado_provincia.nome as nome_estado_provincia', 'Cidade.nome as nome_cidade', 'Pais.cod_pais', 'Cidade.cod_cidade', 'Estado_provincia.cod_est_prov')
          ->where('cod_cidade', '=', $pessoaUsuario->Cidade_cod_cidade)->first();

      if ($pessoaUsuario->hasRole('admin') && $usuarioLogado->hasRole('admin')) {

        return view('perfil.perfil', compact('pessoaUsuario', 'localizacao', 'usuarioLogado'));
      }

      if($pessoaUsuario->hasRole('propositor')){
        $usuarioTipo = User::join('Usuario_Propositor', 'Usuario.cod_usuario', '=', 'Usuario_Propositor.Usuario_cod_usuario')
            ->where('Usuario.Pessoa_cod_pessoa', '=', $pessoaUsuario->cod_pessoa)->first();

        $areasConhecimento = null;
      }

      if($pessoaUsuario->hasRole('parecerista')){
        $usuarioTipo = User::join('Usuario_Parecerista', 'Usuario.cod_usuario', '=', 'Usuario_Parecerista.Usuario_cod_usuario')
            ->where('Usuario.Pessoa_cod_pessoa', '=', $pessoaUsuario->cod_pessoa)->first();

        $areasConhecimento = GrandeArea::join('Area_Conhecimento', 'Area_Conhecimento.Grande_Area_cod_grande_area', 'Grande_Area.cod_grande_area')
          ->leftJoin('Subarea', 'Subarea.Area_Conhecimento_cod_area_conhec', 'Area_Conhecimento.cod_area_conhec')
          ->leftJoin('Especialidade', 'Especialidade.Subarea_cod_subarea', 'Subarea.cod_subarea')
          ->where('Grande_Area.cod_grande_area', '=', $usuarioTipo->Grande_Area_cod_grande_area)
          ->select('Grande_Area.nome as nome_grande_area', 'Area_Conhecimento.nome as nome_area_conhecimento', 'Subarea.nome as nome_subarea', 'Especialidade.nome as nome_especialidade')
          ->first();

        //var_dump($areasConhecimento);
      }

      $instituicaoVinculo = Instituicao::leftJoin('Vinculo_Institucional', 'Vinculo_Institucional.Instituicao_cod_instituicao', 'Instituicao.cod_instituicao')
        ->where('cod_instituicao', '=', $usuarioTipo->Instituicao_cod_instituicao)
        ->select('Instituicao.nome as nome_instituicao', 'Instituicao.sigla', 'Vinculo_Institucional.nome as nome_vinculo', 'Instituicao.cod_instituicao', 'Vinculo_Institucional.cod_vinculo')
        ->first();

      $telefone = Telefone::join('Pessoa', 'Pessoa.cod_pessoa', '=','Telefone.Pessoa_cod_pessoa')
          ->where('Telefone.tipo', '=', 1)
          ->where('Pessoa.cod_pessoa', '=', $pessoaUsuario->cod_pessoa)
          ->select('Telefone.*')
          ->first();

      $email = Email::join('Pessoa', 'Pessoa.cod_pessoa', '=','Email.Pessoa_cod_pessoa')
          ->where('Email.tipo', '=', 1)
          ->where('Pessoa.cod_pessoa', '=', $pessoaUsuario->cod_pessoa)
          ->select('Email.*')
          ->first();

      return view('perfil.edit', compact('pessoaUsuario', 'localizacao', 'instituicaoVinculo', 'telefone', 'email', 'usuarioTipo', 'usuarioLogado', 'areasConhecimento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilEditFormRequest $request)
    {

      Pessoa::where('cod_pessoa', $request->get('cod_pessoa'))->update([
        'nome'=>$request->get('nome'),
        'sobrenome'=>$request->get('sobrenome'),
        'sexo'=>$request->get('sexo'),
        'cpf'=>$request->get('cpf'),
        'rg'=>$request->get('rg'),
        'estado_civil'=>$request->get('estado_civil'),
        'logradouro'=>$request->get('logradouro'),
        'bairro'=>$request->get('bairro'),
        'cep'=>$request->get('cep'),
      ]);

      User::where('cod_usuario', $request->get('cod_usuario'))->update([
        'email'=>$request->get('email_acesso'),
      ]);

      Instituicao::where('cod_instituicao', $request->get('cod_instituicao'))->update([
        'nome'=>$request->get('instituicao'),
      ]);

      VinculoInstitucional::where('cod_vinculo', $request->get('cod_vinculo'))->update([
        'nome'=>$request->get('vinculo'),
      ]);

      if (Auth::user()->hasRole('parecerista')) {
        GrandeArea::where('cod_grande_area', $request->get('cod_grande_area'))->update([
          'nome'=>$request->get('grande_area'),
        ]);

        AreaConhecimento::where('cod_area_conhec', $request->get('cod_area_conhec'))->update([
          'nome'=>$request->get('area_conhecimento'),
        ]);

        Subarea::where('cod_subarea', $request->get('cod_subarea'))->update([
          'nome'=>$request->get('subarea'),
        ]);

        Especialidade::where('cod_especialidade', $request->get('cod_especialidade'))->update([
          'nome'=>$request->get('especialidade'),
        ]);
      }

      Cidade::where('cod_cidade', $request->get('cod_cidade'))->update([
        'nome'=>$request->get('cidade'),
      ]);

      EstadoProvincia::where('cod_est_prov', $request->get('cod_est_prov'))->update([
        'nome'=>$request->get('estado'),
      ]);

      Pais::where('cod_pais', $request->get('cod_pais'))->update([
        'nome'=>$request->get('pais'),
      ]);

      Telefone::where('cod_telefone', $request->get('cod_telefone'))->update([
        'numero'=>$request->get('telefone'),
      ]);

      Email::where('cod_email', $request->get('cod_email'))->update([
        'endereco'=>$request->get('email_contato'),
      ]);

      return redirect()->back()->with('status', 'Seu perfil foi atualizado com sucesso!');
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

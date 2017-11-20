<?php

namespace App\Http\Controllers;

use App\Pessoa;
use App\Cidade;
use App\UsuarioPropositor;
use App\Instituicao;
use App\Telefone;
use App\Email;
use App\User;
use App\GrandeArea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

      return view('perfil.edit', compact('pessoaUsuario', 'localizacao', 'instituicaoVinculo', 'telefone', 'email', 'usuarioTipo', 'usuarioLogado', 'areasConhecimento'));
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

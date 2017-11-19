<?php

namespace App\Http\Controllers;

use App\Pessoa;
use App\Cidade;
use App\UsuarioPropositor;
use App\Instituicao;
use App\Telefone;
use App\Email;
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
        $pessoa = Pessoa::where('slug', '=', $slug)->first();

        $localizacao = Cidade::join('Estado_provincia', 'Estado_provincia.cod_est_prov', '=', 'Cidade.Estado_provincia_cod_est_prov')
            ->join('Pais', 'Pais.cod_pais', '=', 'Estado_provincia.Pais_cod_pais')
            ->select('Pais.nome as nome_pais', 'Estado_provincia.nome as nome_estado_provincia', 'Cidade.nome as nome_cidade')
            ->where('cod_cidade', '=', $pessoa->Cidade_cod_cidade)->first();

        $propositor = UsuarioPropositor::join('Usuario', 'Usuario.cod_usuario', '=', 'Usuario_Propositor.Usuario_cod_usuario')
            ->where('Usuario.Pessoa_cod_pessoa', '=', $pessoa->cod_pessoa)->first();

        //HACK: Retirar a seguinte verificação e inserir instituição no administrador.
        $instituicaoVinculo = null;
        if ($propositor != null) {
          $instituicaoVinculo = Instituicao::leftJoin('Vinculo_Institucional', 'Vinculo_Institucional.Instituicao_cod_instituicao', 'Instituicao.cod_instituicao')
          ->where('cod_instituicao', '=', $propositor->Instituicao_cod_instituicao)
          ->select('Instituicao.nome as nome_instituicao', 'Instituicao.sigla', 'Vinculo_Institucional.nome as nome_vinculo')
          ->first();
        }

        $telefone = Telefone::join('Pessoa', 'Pessoa.cod_pessoa', '=','Telefone.Pessoa_cod_pessoa')
            ->where('Telefone.tipo', '=', 1)
            ->where('Pessoa.cod_pessoa', '=', $pessoa->cod_pessoa)
            ->select('Telefone.*')
            ->first();

        $email = Email::join('Pessoa', 'Pessoa.cod_pessoa', '=','Email.Pessoa_cod_pessoa')
            ->where('Email.tipo', '=', 1)
            ->where('Pessoa.cod_pessoa', '=', $pessoa->cod_pessoa)
            ->select('Email.*')
            ->first();

        $usuario = Auth::user();
        return view('perfil.perfil', compact('pessoa', 'localizacao', 'instituicaoVinculo', 'telefone', 'email', 'usuario'));
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

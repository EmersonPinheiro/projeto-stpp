<?php

namespace App\Http\Controllers;

use App\Pessoa;
use App\Cidade;
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
    public function show($id)
    {
        $pessoa = Pessoa::where('cod_pessoa', '=', $id)->first();
        $localizacao = Cidade::join('Estado_provincia', 'Estado_provincia.cod_est_prov', '=', 'Cidade.Estado_provincia_cod_est_prov')
            ->join('Pais', 'Pais.cod_pais', '=', 'Estado_provincia.Pais_cod_pais')
            ->select('Pais.nome as nome_pais', 'Estado_provincia.nome as nome_estado_provincia', 'Cidade.nome as nome_cidade')
            ->where('cod_cidade', '=', $pessoa->Cidade_cod_cidade)->first();
        return view('perfil.perfil', compact('pessoa', 'localizacao'));
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

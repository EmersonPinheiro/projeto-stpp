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
    public function store(Request $request)
    {
      //DB::transaction(function(){

        $idProposta = DB::table('Proposta')->insertGetID([
          'data_envio'=>Carbon::now('America/Sao_Paulo')->format('Y-m-d'),
        ]);

        DB::table('Obra')->insert([
          'titulo'=>$request->get('titulo'),
          'subtitulo'=>$request->get('subtitulo'),
          'descricao'=>$request->get('descricao'),
          'resumo'=>$request->get('resumo'),
          'Proposta_cod_proposta'=>$idProposta,
        ]);

        

      //});

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

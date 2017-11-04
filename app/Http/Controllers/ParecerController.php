<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposta;
use App\Obra;
use App\Parecer;
use App\UsuarioParecerista;
use App\Material;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ParecerFormRequest;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class ParecerController extends Controller
{
    public function __construct()
    {
      if (!Auth::check()) {
        return redirect('/');
      }
      elseif(!Auth::user()->hasRole('parecerista')){
        return redirect('/')->withErrors('Acesso não permitido!');
      }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasRole('parecerista')){
          return redirect('/')->withErrors('Acesso não permitido!');
        }

        $usuario = Auth::user()->getAttributes();
        $parecerista = UsuarioParecerista::where('Usuario_cod_usuario', '=', $usuario['cod_usuario'])->first();

        $obrasPareceres = Parecer::join('Proposta', 'Parecer.Proposta_cod_proposta', '=', 'Proposta.cod_proposta')
                         ->join('Obra', 'Obra.Proposta_cod_proposta', '=', 'Proposta.cod_proposta')
                         ->where('Parecer.Usuario_Parecerista_cod_parecerista', '=', $parecerista['cod_parecerista'])
                         ->select('Obra.*', 'Parecer.*')
                         ->get();

        return view('painel-parecerista', compact('obrasPareceres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      if(!Auth::user()->hasRole('parecerista')){
        return redirect('/')->withErrors('Acesso não permitido!');
      }
      $usuario = Auth::user()->getAttributes();
      $parecerista = UsuarioParecerista::where('Usuario_cod_usuario', '=', $usuario['cod_usuario'])->first();

      $obraParecer = Parecer::join('Proposta', 'Parecer.Proposta_cod_proposta', '=', 'Proposta.cod_proposta')
                            ->join('Obra', 'Obra.Proposta_cod_proposta', '=', 'Proposta.cod_proposta')
                            ->where('Usuario_Parecerista_cod_parecerista', '=', $parecerista['cod_parecerista'])
                            ->where('cod_parecer', '=', $id)
                            ->first();

      if ($obraParecer->prazo_restante == 0) {

        return redirect()->back()->withErrors('O prazo para esta proposta acabou. Entre em contato com a Editora UEPG.');
      }

      //ID DA ÚLTIMA VERSÃO DO MATERIAL ASSOCIADO À OBRA
      $idMaterial = Material::join('Obra', 'Material.Obra_cod_obra', '=', 'Obra.cod_obra')
                          ->where('cod_obra', '=', $obraParecer->cod_obra)
                          ->max('cod_material');

      return view('pareceres.create', compact('obraParecer', 'idMaterial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParecerFormRequest $request, $id)
    {
        $parecer = Parecer::where('cod_parecer', '=', $id)->first();

        if ($parecer->url_documento != null) {
          return redirect('/enviar-parecer/'.$id)->withErrors('Você já enviou um parecer para esta proposta!');
        }

        $docpath = Storage::putFile('pareceres', $request->file('parecer'), 'private');

        //TODO: Verificar prazo.

        $parecer->url_documento = $docpath;
        $parecer->save();
        return redirect('/painel-parecerista')->with('status', 'Seu parecer foi enviado!');
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

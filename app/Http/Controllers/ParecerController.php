<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proposta;
use App\Obra;
use App\Parecer;
use App\UsuarioParecerista;
use App\Material;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ParecerFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use App\Notifications\ParecerEnviado;
use App\Notifications\ProrrogacaoSolicitada;
use App\Notifications\PrazoProrrogado;

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

        $parecer->url_documento = $docpath;
        $parecer->save();

        $admin = User::join('Usuario_Adm', 'Usuario.cod_usuario', '=', 'Usuario_Adm.Usuario_cod_usuario')
                             ->get();

        Notification::send($admin->all(), new ParecerEnviado($parecer));

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
        $url = Parecer::where('cod_parecer', $id)->select('Parecer.url_documento')->first();

        if ($url == null) {
          return redirect()->back()->withErrors('Ops! Este parecer ainda não foi enviado.');
        }

        $pathToFile=storage_path()."/app/".$url->url_documento;
        return response()->file($pathToFile);
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

    public function solicitarPrazo($id)
    {
      $parecer = Parecer::where('cod_parecer', '=', $id)->first();

      $admin = User::join('Usuario_Adm', 'Usuario.cod_usuario', '=', 'Usuario_Adm.Usuario_cod_usuario')
                           ->get();

      Notification::send($admin, new ProrrogacaoSolicitada($parecer));

      return redirect()->back()->with('status', 'Sua solicitação foi enviada. Aguarde até que o administrador prorrogue o prazo.');
    }

    public function prorrogarPrazo($id)
    {
      if (!Auth::user()->hasRole('admin')) {
        return redirect()->back()->withErrors('Ops! Parece que você não pode fazer isso');
      }

      $parecer = Parecer::where('cod_parecer', '=', $id)->first();

      if ($parecer->prazo_restante > 0) {
        return redirect()->back()->withErrors('Ops! Parece que este parecer ainda tem prazo restante.');
      }
      else {
        $parecer->prazo_envio = Carbon::now('America/Sao_Paulo')->addDays(31)->format('Y-m-d');
        $parecer->save();

        $parecerista = User::join('Usuario_Parecerista', 'Usuario.cod_usuario', '=', 'Usuario_Parecerista.Usuario_cod_usuario')
                           ->where('cod_parecerista', '=', $parecer->Usuario_Parecerista_cod_parecerista)
                           ->first();

        Notification::send($parecerista, new PrazoProrrogado($parecer));

        return redirect()->back()->with('status', 'Prazo prorrogado por mais 30 dias!');
      }
    }
}

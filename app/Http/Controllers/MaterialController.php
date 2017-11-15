<?php

namespace App\Http\Controllers;

use App\User;
use App\Proposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NovaVersaoObraEnviada;
use App\Http\Requests\MaterialVersionFormRequest;

class MaterialController extends Controller
{
    public function downloadMaterial($id)
    {
        $url = DB::table('Material')->where('cod_material', $id)->select('Material.url_documento')->first();
        $pathToFile = storage_path()."/app/".$url->url_documento;
        return response()->download($pathToFile);

      //IMPLEMENTAR DOWNLOAD DO ZIP DAS IMAGENS
    }

    public function showMaterial($id)
    {
      $url = DB::table('Material')->where('cod_material', $id)->select('Material.url_documento')->first();
      $pathToFile=storage_path()."/app/".$url->url_documento;
      return response()->file($pathToFile); // se for .doc ele faz o download direto com o nome da rota
    }

    /*
    Envia uma nova versão da proposta.
    */
    public function newVersion(MaterialVersionFormRequest $request)
    {
      $docpath = Storage::putFile('documentos', $request->file('novoDoc'), 'private');
      $ofcpath = Storage::putFile('oficios-de-alteracao', $request->file('oficio'), 'private');

      $versao = DB::table('Material')
        ->join('Obra', 'Material.Obra_cod_obra', '=', 'Obra.cod_obra')
        ->where('cod_obra', $request->get('cod_obra'))
        ->max('Material.versao');

      DB::table('Material')
        ->join('Obra', 'Material.Obra_cod_obra', '=', 'Obra.cod_obra')
        ->where('cod_obra', $request->get('cod_obra'))
        ->insert([
          'versao'=>$versao+1,
          'url_documento'=>$docpath,
          'Obra_cod_obra'=>$request->get('cod_obra'),
      ]);

      DB::table('Oficio_Alteracoes')->insertGetID([
        'url_documento'=>$ofcpath,
        'Proposta_cod_proposta'=>$request->get('cod_proposta'),
      ]);

      $proposta = Proposta::where('cod_proposta', '=', $request->get('cod_proposta'))->first();
      $admin = User::join('Usuario_Adm', 'Usuario.cod_usuario', '=', 'Usuario_Adm.Usuario_cod_usuario')
                           ->get();

      Notification::send($admin->all(), new NovaVersaoObraEnviada($proposta));

      return redirect(action('PropostasController@show', $request->cod_proposta))->with('status', 'A nova versão da obra foi enviada!');

    }
}

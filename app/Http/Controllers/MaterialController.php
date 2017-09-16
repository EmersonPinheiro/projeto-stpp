<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
      $docpath = Storage::putFile('documentos', $request->file('novoDoc'), 'public');
      $ofcpath = Storage::putFile('oficios-de-alteracao', $request->file('oficio'), 'public');

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
      return redirect(action('PropostasController@show', $request->cod_proposta))->with('status', 'A nova versão da obra foi enviada!');

    }
}

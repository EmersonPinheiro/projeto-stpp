<?php

namespace App\Http\Controllers;

use App\User;
use App\Proposta;
use App\DocSugestaoAlteracoes;
use App\OficioAlteracoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NovaVersaoObraEnviada;
use App\Http\Requests\MaterialVersionFormRequest;

class DocumentosController extends Controller
{
    public function downloadMaterial($id)
    {
        $doc = DB::table('Material')->where('cod_material', $id)->select('Material.url_documento')->first();
        $pathToFile = storage_path()."/app/".$doc->url_documento;
        return response()->download($pathToFile);

      ///IMPLEMENTAR DOWNLOAD DO ZIP DAS IMAGENS
    }

    public function showMaterial($id)
    {
      $url = DB::table('Material')->where('cod_material', $id)->select('Material.url_documento')->first();
      $pathToFile=storage_path()."/app/".$url->url_documento;
      return response()->file($pathToFile); // se for .doc ele faz o download direto com o nome da rota
    }

    public function showDocSugestao($id)
    {
      $doc = DocSugestaoAlteracoes::where('cod_sug_alteracoes', '=', $id)->select('url_documento')->first();
      $pathToFile = storage_path()."/app/".$doc->url_documento;
      return response()->file($pathToFile);
    }

    public function showOficioAlteracao($id)
    {
      $doc = OficioAlteracoes::where('cod_oficio', '=', $id)->select('url_documento')->first();
      $pathToFile = storage_path()."/app/".$doc->url_documento;
      return response()->file($pathToFile);
    }

}

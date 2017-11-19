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
    public function downloadMaterialIdentificado($id)
    {
        $material = DB::table('Material')->where('cod_material', $id)->select('Material.url_documento')->first();
        $pathToFile = storage_path()."/app/".$material->url_documento;
        return response()->download($pathToFile);
      ///IMPLEMENTAR DOWNLOAD DO ZIP DAS IMAGENS
    }

    public function downloadMaterialNaoIdentificado($id)
    {
        $material = DB::table('Material')->where('cod_material', $id)->select('Material.url_documento_nao_ident')->first();
        $pathToFile = storage_path()."/app/".$material->url_documento_nao_ident;
        return response()->download($pathToFile);

    }

    public function downloadImagens($id)
    {
        $material = DB::table('Material')->where('cod_material', $id)->select('Material.url_imagens')->first();

        if ($material->url_imagens == null) {
          return redirect()->back()->with('status', 'Desculpe, não há imagens cadastradas para esta versão do material.');
        }
        $pathToFile = storage_path()."/app/".$material->url_imagens;
        return response()->download($pathToFile);
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

    public function showMaterialParecerista($id)
    {
      $material = DB::table('Material')->where('cod_material', $id)->select('Material.url_documento_parecerista')->first();
      $pathToFile = storage_path()."/app/".$material->url_documento_parecerista;
      return response()->file($pathToFile);
    }

}

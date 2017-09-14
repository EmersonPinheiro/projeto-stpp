<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function downloadMaterial($id)
    {
      $url = DB::table('Material')->where('cod_material', $id)->select('Material.url_documento')->first();
      $pathToFile = storage_path()."/app/".$url->url_documento;
      return response()->download($pathToFile, 'documento.pdf');

      //IMPLEMENTAR DOWNLOAD DO ZIP DAS IMAGENS
    }

    public function showMaterial($id)
    {
      $url = DB::table('Material')->where('cod_material', $id)->select('Material.url_documento')->first();
      $pathToFile=storage_path()."/app/".$url->url_documento;
      return response()->file($pathToFile); // se for .doc ele faz o download direto com o nome da rota. Ex: showMat (nome da rota)
    }
}

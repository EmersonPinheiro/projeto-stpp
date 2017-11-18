<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConviteParecerista;
use App\User;
use App\UsuarioParecerista;
use App\UsuarioPropositor;
use App\Proposta;
use App\Obra;
use App\Parecer;
use App\Material;
use Carbon\Carbon;
use App\Mail\PareceristaConvidado;
use App\Http\Requests\ConviteFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
class ConviteController extends Controller
{
      public function invite($id)
      {
        $codProposta = $id;
        return view('invite', compact('codProposta'));
      }

      public function process(ConviteFormRequest $request)
      {
        do {
          $token = str_random();
      }
      while (ConviteParecerista::where('token', $token)->first());

      $convite = ConviteParecerista::create([
              'email' => $request->get('email'),
              'nome' => $request->get('nome'),
              'sobrenome' => $request->get('sobrenome'),
              'Proposta_cod_proposta' =>$request->get('proposta'),
              'token' => $token
      ]);

      $obra = Obra::where('Proposta_cod_proposta', '=', $request->get('proposta'))->first();

      //NOTE: Insere na última versão do material.
      $docpath = Storage::putFile('documentos', $request->file('documento_parecerista'), 'private');

      $material = Material::where('versao', '=', DB::raw("(SELECT max(versao) FROM Material WHERE Material.Obra_cod_obra = $obra->cod_obra)"))->first();
      $material->update(['url_documento_parecerista'=>$docpath]);
      $material->save();

      Mail::to($request->get('email'))->send(new PareceristaConvidado($convite, $obra));

      return redirect()->back()->with('status', 'O convite foi enviado.');
    }

    public function accept($token)
    {
      if (!$convite = ConviteParecerista::where('token', $token)->first()) {
        abort(404);
      }

      $proposta = Proposta::where('cod_proposta', '=', $convite->Proposta_cod_proposta)->first();

      if ($usuario = User::where('email', '=', $convite->email)->first()) {

        $attributes = $usuario->getAttributes();

        if($usuarioParecerista = usuarioParecerista::where('Usuario_cod_usuario', '=', $usuario['cod_usuario'])->first()){

          $parecer = Parecer::create([
            'prazo_envio'=>Carbon::now('America/Sao_Paulo')->addDays(61)->format('Y-m-d'),
            'Proposta_cod_proposta'=>$proposta->cod_proposta,
            'Usuario_Parecerista_cod_parecerista'=>$usuarioParecerista->cod_parecerista,
          ]);

          $convite->delete();

          if (!Auth::check() && Auth::user()->hasRole('parecerista')) {
            return redirect('/home')->with('status', 'O convite foi aceito, faça login para avaliar a obra.');
          }
          return view('painel-parecerista')->with('status', 'O convite foi aceito. Fique atento ao prazo de envio do parecer.');
        }
        else{
/*
        $propositor = UsuarioPropositor::where('Usuario_cod_usuario', '=', $attributes['cod_usuario'])
                                ->select('Departamento_cod_departamento')->first();
*/

        //TODO: Verificar uma maneira de inserir instituicao e grande área vindas do propositor.
        $usuarioParecerista = UsuarioParecerista::create([
          'Usuario_cod_usuario'=>$attributes['cod_usuario'],
          //'Instituicao_cod_instituicao'=>$instituicao->cod_instituicao,
          //'Grande_Area_cod_grande_area'=>$grandeArea->cod_grande_area,
          'Instituicao_cod_instituicao'=>'1',
          'Grande_Area_cod_grande_area'=>'1',
        ]);

        $parecer = Parecer::create([
          'prazo_envio'=>Carbon::now('America/Sao_Paulo')->addDays(61)->format('Y-m-d'),
          'Proposta_cod_proposta'=>$proposta->cod_proposta,
          'Usuario_Parecerista_cod_parecerista'=>$usuarioParecerista->cod_parecerista,
        ]);

        $usuario->attachRole(3);
        $convite->delete();
        return redirect('/home')->with('status', 'O convite foi aceito, faça login para avaliar a obra.');
      }
    }
    return view('cadastroParecerista', compact('convite'));
  }
}

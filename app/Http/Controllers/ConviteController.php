<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConviteParecerista;
use App\User;
use App\UsuarioParecerista;
use App\UsuarioPropositor;
use App\Proposta;
use App\Parecer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Mail\PareceristaConvidado;
use Illuminate\Support\Facades\Mail;

class ConviteController extends Controller
{
    public function invite($id)
    {
      $codProposta = $id;
      return view('invite', compact('codProposta'));
    }

    public function process(Request $request)
    {
      do {
        $token = str_random();
    }
    while (ConviteParecerista::where('token', $token)->first());

    $convite = ConviteParecerista::create([
            'email' => $request->get('email'),
            'proposta' =>$request->get('proposta'),
            'token' => $token
        ]);

        Mail::to($request->get('email'))->send(new PareceristaConvidado($convite));

        //TODO: Retornar uma mensagem (possívelmente modal).
        return redirect()->back()->with('status', 'O convite foi enviado.');
    }

    public function accept($token)
    {
      if (!$convite = ConviteParecerista::where('token', $token)->first()) {
        abort(404);
      }

      $convite->aceito = true;
      $convite->save();

      $proposta = Proposta::where('cod_proposta', '=', $convite->proposta)->first();

      if ($usuario = User::where('email', '=', $convite->email)->first()) {

        $attributes = $usuario->getAttributes();

        if($usuarioParecerista = usuarioParecerista::where('Usuario_cod_usuario', '=', $usuario['cod_usuario'])->first()){

          $parecer = Parecer::create([
            'prazo_envio'=>Carbon::now('America/Sao_Paulo')->addDays(61)->format('Y-m-d'),
            'Proposta_cod_proposta'=>$proposta->cod_proposta,
            'Usuario_Parecerista_cod_parecerista'=>$usuarioParecerista->cod_parecerista,
          ]);
          $convite->delete();
          return redirect('/home')->with('status', 'O convite foi aceito, faça login para avaliar a obra.');
        }
        else{

        $propositor = UsuarioPropositor::where('Usuario_cod_usuario', '=', $attributes['cod_usuario'])
                                ->select('Departamento_cod_departamento')->first();

        $usuarioParecerista = UsuarioParecerista::create([
          'Usuario_cod_usuario'=>$attributes['cod_usuario'],
          'Departamento_cod_departamento'=>$propositor->Departamento_cod_departamento,
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

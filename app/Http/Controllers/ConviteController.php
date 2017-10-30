<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConviteParecerista;
use App\Mail\PareceristaConvidado;
use Illuminate\Support\Facades\Mail;

class ConviteController extends Controller
{
    public function invite($id)
    {
      //$obra = DB::table('Obra')->where('Proposta_cod_proposta', $id)->first();
      $codProposta = $id;
      return view('invite', compact('codProposta'));
    }

    public function process(Request $request)
    {
      do {
        $token = str_random();
    }
    while (ConviteParecerista::where('token', $token)->first());

    $invite = ConviteParecerista::create([
            'email' => $request->get('email'),
            'proposta' =>$request->get('proposta'),
            'token' => $token
        ]);

        Mail::to($request->get('email'))->send(new PareceristaConvidado($invite));

        //return redirect()->back();

        return 'Convite enviado!';
    }

    public function accept($token)
    {
      if (!$convite = ConviteParecerista::where('token', $token)->first()) {

        abort(404);
      }

    $convite->aceito = true;
    $convite->save();

    //TRATAMENTO DA ACEITAÇÃO DO CONVITE
    return view('cadastroParecerista', compact('convite'));
    }
  }

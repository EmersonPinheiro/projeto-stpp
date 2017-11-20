<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password'), 'confirmed'=> 1])) {
          return $this->sendLoginResponse($request);
            //return redirect('/')->withErrors('Cadastro ainda não confirmado! Por favor, verifique seus e-mails e confirme seu cadastro');
        }

        return $this->sendFailedLoginResponse($request)->withErrors('Cadastro não confirmado!');
    }

    //TODO: Verificar uma solução melhor dos redirecionamentos.
    public function authenticated()
    {
      $usuario = Auth::user();

      if ($usuario->hasRole('propositor') && $usuario->hasRole('parecerista')) {
        return redirect('/modo-acesso');
      }
      elseif ($usuario->hasRole('propositor')) {
        return redirect('/propostas');
      }
      elseif($usuario->hasRole('parecerista')) {
        return redirect('/painel-parecerista');
      }
      elseif($usuario->hasRole('admin')) {
        return redirect('/admin/painel-administrador');
      }
      else{
        $usuario->logout();
        return redirect('/')->withErrors('Ocorreu um erro durante o login.');
      }
    }

}

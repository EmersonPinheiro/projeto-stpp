<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected function redirectTo($user_role)
    {
      if ($user_role == 'propositor') {
        return 'propostas';
      }
      elseif($user_role == 'parecerista'){
        return 'painel-parecerista';
      }
    }
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

    //TODO: CRIAR FUNÇÃO DE REDIRECIONAMENTO PARA DIFERENCIAR OS USUÁRIOS
/*
    public function authenticate(Request $request)
    {
      $email     = $request->get('email');
      $password  = $request->get('password');
      $user_role = $request->get('user_role');

      if($user_role == 'propositor'){
        if(Auth::user()->hasRole('propositor')){
          if(Auth::attempt(['email' => $email, 'password' => $password])){
            return $this->authenticated($request);
          }
        }
        else{
          return redirect('/')->with('status', 'Acesso negado!');
        }
      }

      elseif($user_role == 'parecerista'){
        if(Auth::user()->hasRole('parecerista')){
          if(Auth::attempt(['email' => $email, 'password' => $password])){
            return $this->authenticated($request);
          }
        }
        else{
          return redirect('/')->with('status', 'Acesso negado!');
        }
      }
      else{
          return redirect('/')->with('status', 'Erro ao fazer login!');
      }

    }*/

    //TODO: Verificar uma solução melhor.
    public function authenticated($request)
    {
      $user_role = $request->get('user_role');

      if ($user_role == 'propositor' && Auth::user()->hasRole('propositor')){
        return redirect('/propostas');
      }
      elseif($user_role == 'parecerista' && Auth::user()->hasRole('parecerista')){
        return redirect('/painel-parecerista');
      }
      else{
        Auth::logout();
        return redirect('/')->withErrors('Acesso não permitido!');
      }
    }

}

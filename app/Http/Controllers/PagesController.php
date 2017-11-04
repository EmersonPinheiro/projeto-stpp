<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('home');
    }

    public function cadastro()
    {
        return view('cadastro');
    }

    public function contato()
    {
        return view('contato');
    }
    public function ajuda()
    {
        return view('ajuda');
    }
    public function restrito()
    {
        return view('restrito');
    }
    public function modoAcesso()
    {
        return view('modo-acesso');
    }
}

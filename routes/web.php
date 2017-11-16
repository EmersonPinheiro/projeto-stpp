<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','PagesController@home');
Route::get('/home','PagesController@home'); //TODO: Retirar. Solução provisória.
Route::get('/cadastro', 'PagesController@cadastro')->middleware('guest'); //RETIRAR (SUBSTITUIR PELO REGISTER PADRÃO)
Route::get('/contato', 'PagesController@contato');
Route::get('/ajuda', 'PagesController@ajuda');

Route::group(['middleware' => ['auth']], function () {
  Route::get('/enviar-proposta', 'PropostasController@create');
  Route::post('/enviar-proposta', 'PropostasController@store');
  Route::get('/propostas', 'PropostasController@index');
  Route::get('/propostas/{id?}', 'PropostasController@show');

  Route::post('/propostas/{id?}/enviarNovaVersao', 'PropostasController@novaVersaoObra')->name('enviarNovaVersao');

  Route::get('/propostas/{id?}/edit', 'PropostasController@edit');
  Route::post('/propostas/{id?}/edit', 'PropostasController@update');
  Route::get('/propostas/{id?}/downloadMaterial', 'DocumentosController@downloadMaterial');
  Route::get('/propostas/{id?}/showMaterial', 'DocumentosController@showMaterial');

  Route::post('/propostas/{id?}/solicitarCancelamento', 'PropostasController@solicitarCancelamento');

  Route::get('/propostas/{id?}/convidar-parecerista', 'ConviteController@invite')->name('invite');
  Route::post('/propostas/{id?}/convidar-parecerista', 'ConviteController@process')->name('process');
  Route::get('/painel-parecerista', 'ParecerController@index');
  Route::get('/modo-acesso', 'PagesController@modoAcesso');
  Route::get('/enviar-parecer/{parecer?}', 'ParecerController@create');
  Route::post('/enviar-parecer/{parecer?}', 'ParecerController@store');
  Route::get('/enviar-parecer/{parecer?}/solicitarPrazo', 'ParecerController@solicitarPrazo');
  Route::get('/admin/painel-administrador', 'AdminController@index');
  Route::get('/admin/painel-administrador/{id?}', 'AdminController@show');
  Route::get('/admin/painel-administrador/{id?}/edit', 'AdminController@edit');
  Route::post('/admin/painel-administrador/{id?}/edit', 'AdminController@update');
  Route::get('/admin/painel-administrador/{id?}/cancelarProposta', 'AdminController@cancelarProposta');
  Route::get('/admin/painel-administrador/{id?}/showParecer', 'ParecerController@show');
  Route::get('/admin/painel-administrador/{id?}/prorrogarPrazo', 'ParecerController@prorrogarPrazo');
  Route::post('/admin/painel-administrador/{id?}/solicitarNovaVersao', 'AdminController@solicitarNovaVersao')->name('solicitarNovaVersao');

  //TODO: Verificar se existe uma implementação melhor das seguintes rotas de download
  //Route::get('/showDocSugestao/{$id?}', 'DocumentosController@showDocSugestao')->name('showDocSugestao');
  //Route::get('/showOficioAlteracao/{$id?}', 'DocumentosController@showOficioAlteracao')->name('showOficioAlteracao');
  Route::get('/admin/painel-administrador/{id?}/showDocSugestao', 'DocumentosController@showDocSugestao');
  Route::get('/propostas/{id?}/showDocSugestao', 'DocumentosController@showDocSugestao');
  Route::get('/admin/painel-administrador/{id?}/showOficioAlteracao', 'DocumentosController@showOficioAlteracao');
  Route::get('/admin/painel-administrador/{id?}/relatorio', 'RelatorioController@index');
  //Route::get('/admin/painel-administrador/{id?}/printRelatorio', 'RelatorioController@printRelatorio');

});

Route::get('/accept/{token}', 'ConviteController@accept')->name('accept');

Route::get('/acesso-restrito', 'PagesController@restrito');

Auth::routes();

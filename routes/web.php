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
Route::get('/cadastro', 'PagesController@cadastro'); //RETIRAR (SUBSTITUIR PELO REGISTER PADRÃO)
Route::get('/contato', 'PagesController@contato');
Route::get('/ajuda', 'PagesController@ajuda');

Route::group(['middleware' => ['auth']], function () {
  Route::get('/enviar-proposta', 'PropostasController@create');
  Route::post('/enviar-proposta', 'PropostasController@store');
  Route::get('/propostas', 'PropostasController@index');
  Route::get('/propostas/{id?}', 'PropostasController@show');
  Route::post('/propostas/{id?}', 'MaterialController@newVersion');
  Route::get('/propostas/{id?}/edit', 'PropostasController@edit');
  Route::post('/propostas/{id?}/edit', 'PropostasController@update');
  Route::get('/propostas/{id?}/downloadMaterial', 'MaterialController@downloadMaterial');
  Route::get('/propostas/{id?}/showMaterial', 'MaterialController@showMaterial');
  Route::get('/propostas/{id?}/convidar-parecerista', 'ConviteController@invite')->name('invite');
  Route::post('/propostas/{id?}/convidar-parecerista', 'ConviteController@process')->name('process');
  Route::get('/accept/{token}', 'ConviteController@accept')->name('accept');
  Route::get('/painel-parecerista', 'ParecerController@index');
  Route::get('/modo-acesso', 'PagesController@modoAcesso');
  Route::get('/enviar-parecer/{parecer?}', 'ParecerController@create');
  Route::post('/enviar-parecer/{parecer?}', 'ParecerController@store');
  Route::get('/admin/painel-administrador', 'AdminController@index');
  Route::get('/admin/painel-administrador/{id?}', 'AdminController@show');
});


Route::get('/acesso-restrito', 'PagesController@restrito');

Auth::routes();

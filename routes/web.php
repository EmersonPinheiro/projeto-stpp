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
Route::get('/enviar-proposta', 'PropostasController@create')->middleware('auth');
Route::post('/enviar-proposta', 'PropostasController@store')->middleware('auth');
Route::get('/propostas', 'PropostasController@index')->middleware('auth');
Route::get('/propostas/{id?}', 'PropostasController@show')->middleware('auth');
Route::post('/propostas/{id?}', 'MaterialController@newVersion')->middleware('auth');
Route::get('/propostas/{id?}/edit', 'PropostasController@edit')->middleware('auth');
Route::post('/propostas/{id?}/edit', 'PropostasController@update')->middleware('auth');
Route::get('/propostas/{id?}/downloadMaterial', 'MaterialController@downloadMaterial')->middleware('auth');
Route::get('/propostas/{id?}/showMaterial', 'MaterialController@showMaterial')->middleware('auth');
Route::get('/propostas/{id?}/convidar-parecerista', 'ConviteController@invite')->name('invite');
Route::post('/propostas/{id?}/convidar-parecerista', 'ConviteController@process')->name('process');
Route::get('/accept/{token}', 'ConviteController@accept')->name('accept');
Route::get('/painel-parecerista', 'ParecerController@index')->middleware('auth');
Route::get('/modo-acesso', 'PagesController@modoAcesso')->middleware('auth');
Route::get('/enviar-parecer/{parecer?}', 'ParecerController@create')->middleware('auth');
Route::post('/enviar-parecer/{parecer?}', 'ParecerController@store')->middleware('auth');

Route::get('/acesso-restrito', 'PagesController@restrito');

Auth::routes();

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
Route::get('/cadastro', 'PagesController@cadastro'); //RETIRAR (SUBSTITUIR PELO REGISTER PADRÃO)
Route::get('/contato', 'PagesController@contato');
Route::get('/ajuda', 'PagesController@ajuda');
Route::get('/enviar-proposta', 'PropostasController@create')->middleware('auth');
Route::post('/enviar-proposta', 'PropostasController@store')->middleware('auth');
Route::get('/painel', 'PropostasController@index')->middleware('auth');
Route::get('/painel/{id?}', 'PropostasController@show')->middleware('auth');
Route::post('/painel/{id?}', 'MaterialController@newVersion')->middleware('auth');
Route::get('/painel/{id?}/edit', 'PropostasController@edit')->middleware('auth');
Route::post('/painel/{id?}/edit', 'PropostasController@update')->middleware('auth');
Route::get('/painel/{id?}/downloadMaterial', 'MaterialController@downloadMaterial')->middleware('auth');
Route::get('/painel/{id?}/showMaterial', 'MaterialController@showMaterial')->middleware('auth');
Auth::routes();

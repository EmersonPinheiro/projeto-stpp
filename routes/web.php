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
Route::get('/enviar-proposta', 'PropostasController@create');
Route::post('/enviar-proposta', 'PropostasController@store');
Route::get('/painel', 'PropostasController@index');
Route::get('/painel/{id?}', 'PropostasController@show');
Route::get('/painel/{id?}/edit', 'PropostasController@edit');
Route::post('/painel/{id?}/edit', 'PropostasController@update');
<<<<<<< HEAD
Route::get('/painel/{id?}/downloadMat', 'MaterialController@downloadMaterial');
Route::get('/painel/{id?}/showMat', 'MaterialController@showMaterial');
=======
Route::get('/cadastro', 'PropositorController@create');
ROute::post('/cadastro', 'PropositorController@store');
>>>>>>> c0fa4d43eb1ee3840ba8736434ca36311129e620

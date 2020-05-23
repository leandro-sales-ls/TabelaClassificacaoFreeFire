<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Time
Route::resource('/time', 'TimeController');
Route::get('/time-list/{id}', 'TimeController@find');
Route::put('/time-edit/{id}', 'TimeController@update');
Route::get('/time-delete/{id}', 'TimeController@delete');

//Partida
Route::resource('/partida', 'PartidaController');
Route::get('/partida-list/{id}', 'PartidaController@find');
Route::put('/partida-edit/{id}', 'PartidaController@update');
Route::get('/partida-delete/{id}', 'PartidaController@delete');

//Ponto Kill
Route::resource('/ponto-kill', 'PontoKillController');
Route::get('/ponto-kill-list/{id}', 'PontoKillController@find');
Route::put('/ponto-kill-edit/{id}', 'PontoKillController@update');
Route::get('/ponto-kill-delete/{id}', 'PontoKillController@delete');

Route::resource('/ponto-posicao', 'PontoPosicaoController');
Route::get('/ponto-posicao-list/{id}', 'PontoPosicaoController@find');
Route::put('/ponto-posicao-edit/{id}', 'PontoPosicaoController@update');
Route::get('/ponto-posicao-delete/{id}', 'PontoPosicaoController@delete');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

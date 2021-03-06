<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {


	//Time
	Route::get('time', 'TimeController@index')->name('time');
	Route::get('time-create', function () {
		return view('pages.times.time-create');
	})->name('table');
	Route::post('time-create', 'TimeController@store');
	Route::get('/time-delete/{id}', 'TimeController@delete');
	Route::get('/time-edit/{id}', 'TimeController@edit');
	Route::get('/time-update/{id}', 'TimeController@update');


	//partida
	Route::get('partida', 'PartidaController@index')->name('partida');
	Route::get('partida-create', function () {
		return view('pages.partidas.partida-create');
	})->name('table');
	Route::post('partida-create', 'PartidaController@store');
	Route::get('/partida-delete/{id}', 'PartidaController@delete');
	Route::get('/partida-edit/{id}', 'PartidaController@edit');
	Route::get('/partida-update/{id}', 'PartidaController@update');


	//Ponto Kill 
	Route::get('ponto-kill', 'PontoKillController@index')->name('pontoKill');
	Route::get('ponto-kill-create', function () {
		return view('pages.pontosKill.ponto-kill-create');
	})->name('table');
	Route::post('ponto-kill-create', 'PontoKillController@store');
	Route::get('/ponto-kill-delete/{id}', 'PontoKillController@delete');
	Route::get('/ponto-kill-edit/{id}', 'PontoKillController@edit');
	Route::get('/ponto-kill-update/{id}', 'PontoKillController@update');


	//Ponto Kill 
	Route::get('ponto-posicao', 'PontoPosicaoController@index')->name('pontoPosicao');
	Route::get('ponto-posicao-create', function () {
		return view('pages.pontosPosicao.ponto-posicao-create');
	})->name('table');
	Route::post('ponto-posicao-create', 'PontoPosicaoController@store');
	Route::get('/ponto-posicao-delete/{id}', 'PontoPosicaoController@delete');
	Route::get('/ponto-posicao-edit/{id}', 'PontoPosicaoController@edit');
	Route::get('/ponto-posicao-update/{id}', 'PontoPosicaoController@update');


	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});


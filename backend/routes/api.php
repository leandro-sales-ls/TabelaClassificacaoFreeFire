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
//Beneficiário
Route::resource('/time', 'TimeController');

//Periodo
Route::get('/periodo-list', 'PeriodoController@getList');
Route::post('/periodo-filter', 'PeriodoController@filter');
Route::get('/periodo-vinculo/{id}', 'PeriodoController@getVinculo');
Route::get('/periodo-nomes', 'PeriodoController@getNomes');
Route::get('/periodo-vigente', 'PeriodoController@getPeriodoVigente');
Route::resource('/periodos', 'PeriodoController');


// Unidade de Faturamento
Route::get('/unidade-faturamento-list', 'UnidadeFaturamentoController@getList');
Route::post('/unidade-faturamento-filter', 'UnidadeFaturamentoController@filter');
Route::post('/unidade-faturamento-create', 'UnidadeFaturamentoController@store');
Route::get('/unidade-faturamento-edit/{id}', 'UnidadeFaturamentoController@edit');
Route::get('/unidade-faturamento-delete/{id}', 'UnidadeFaturamentoController@delete');
Route::put('/unidade-faturamento-update/{id}', 'UnidadeFaturamentoController@update');
Route::get('/unidade-faturamento-vinculo/{id}', 'UnidadeFaturamentoController@getVinculo');
Route::get('/unidade-faturamento-numero', 'UnidadeFaturamentoController@indicarNumero');
Route::get('/unidade-faturamento-ativos', 'UnidadeFaturamentoController@getListAtivos');
Route::get('/unidade-faturamento-get/{id}', 'UnidadeFaturamentoController@getUnidadeFaturamento');

//Centro de Custo
Route::get('/centro-custo', 'CentroCustoController@getCentroCusto');

//Comarca
Route::get('/comarca', 'ComarcaController@getList');
Route::get('/comarca-get/{id}', 'ComarcaController@getComarca');
Route::get('/comarca-ativos', 'ComarcaController@getListAtivos');

//Unidade
Route::get('/unidade', 'VwUnidadeController@getList');
Route::get('/unidade-ativos', 'VwUnidadeController@getListAtivos');
Route::get('/unidade-get/{id}', 'VwUnidadeController@getUnidade');
Route::get('/unidade-get-nome/{lotacao}', 'VwUnidadeController@getUnidadePorNome');

//Banco
Route::get('/banco-get/{id}', 'BancoController@getBanco');
Route::get('/banco-ativos-compe', 'BancoController@getListAtivosCompe');

//PessoalRH
Route::get('/pessoal-rh-get/{id}', 'VwPessoalRhController@getColaborador');
Route::get('/pessoal-rh', 'VwPessoalRhController@getList');
Route::get('/pessoal-rh-ativos', 'VwPessoalRhController@getListAtivos');
Route::get('/pessoal-rh-membro-servidor-ativos', 'VwPessoalRhController@getListMembroServidor');
Route::get('/pessoal-rh-perfil/{id}', 'VwPessoalRhController@getPerfilUsuario');

//Delegado
Route::get('/delegado', 'DelegadoController@index');
Route::post('/delegado-filter', 'DelegadoController@filter');
Route::post('/delegado-create', 'DelegadoController@store');
Route::get('/delegado-edit/{id}', 'DelegadoController@edit');
Route::put('/delegado-update/{id}', 'DelegadoController@update');
Route::get('/delegado-delete/{id}', 'DelegadoController@delete');
Route::get('/delegado-vinculo/{id}', 'DelegadoController@getVinculo');
Route::get('/delegado-list-beneficiario', 'DelegadoController@getBeneficiarios');
Route::get('/delegado-list', 'DelegadoController@getDelegados');
Route::get('/delegado-beneficiario-colaborador/{colaborador}', 'DelegadoController@getBeneficiariosPorDelegado');

//Despesa
Route::post('/despesa-filter', 'DespesaController@filter');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

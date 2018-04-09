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

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'api'], function() {
    Route::post('login', 'Auth\LoginController@doLogin');
    Route::post('logout', 'Auth\LoginController@doLogout');
});

Route::group(['prefix' => 'api'], function() {
    Route::get('autenticacao/validar', 'AcessoController@validarAcesso');
});

Route::group(['prefix' => 'api'], function() {
    Route::get('user', 'UserController@lista');
    Route::post('user', 'UserController@novo');
    Route::put('user/{id}', 'UserController@editar');
    Route::delete('user/{id}', 'UserController@excluir');
});

Route::group(['prefix' => 'api'], function() {
    Route::get('vereador', 'VereadorController@lista');
    Route::post('vereador', 'VereadorController@novo');
    Route::put('vereador/{id}', 'VereadorController@editar');
    Route::delete('vereador/{id}', 'VereadorController@excluir');
});

Route::group(['prefix' => 'api'], function() {
    Route::get('lei', 'LeiController@lista');
    Route::get('lei/get_tipo', 'LeiController@getTipo');
    Route::post('lei', 'LeiController@novo');
    Route::put('lei/{id}', 'LeiController@editar');
    Route::delete('lei/{id}', 'LeiController@excluir');
});

Route::group(['prefix' => 'api'], function() {
    Route::get('sessao', 'SessaoController@lista');
    Route::get('sessao/get', 'SessaoController@get');
    Route::post('sessao', 'SessaoController@novo');
    Route::put('sessao/{id}', 'SessaoController@editar');
    Route::delete('sessao/{id}', 'SessaoController@excluir');
});

Route::group(['prefix' => 'api'], function() {
    Route::get('registro_sessao/iniciar_sessao', 'RegistroSessaoController@iniciarSessao');
    Route::post('registro_sessao/vincular_lei', 'RegistroSessaoController@vincularLei');
    Route::post('registro_sessao/desvincular_lei', 'RegistroSessaoController@desvincularLei');
    Route::post('registro_sessao/registrar_presenca', 'RegistroSessaoController@registrarPresenca');
    Route::post('registro_sessao/registrar_voto', 'RegistroSessaoController@registrarVoto');
    Route::get('registro_sessao/get_votos', 'RegistroSessaoController@getVotos');
    Route::post('registro_sessao/remover_presenca', 'RegistroSessaoController@removerPresenca');
});


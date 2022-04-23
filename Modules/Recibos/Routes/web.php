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

Route::prefix('recibos')->group(function() {
  Route::get('/', 'RecibosController@index');
  Route::get('/create', 'RecibosController@create');
  Route::get('/show', 'RecibosController@show');
  Route::get('/recibo', 'RecibosController@recibo');
  Route::get('/oficio', 'RecibosController@oficio');
  Route::get('/especificacion', 'RecibosController@especificacion');
  Route::get('/especificacioncomision', 'RecibosController@especificacioncomision');
  Route::get('/imprimir', 'RecibosController@imprimir');
});

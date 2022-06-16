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
  Route::get('/{id}/oficio', 'RecibosController@oficio');
  Route::get('/especificacion', 'RecibosController@especificacion');
  Route::get('/{id}/especificacioncomision', 'RecibosController@especificacioncomision');
  Route::get('/imprimir', 'RecibosController@imprimir');
  Route::get('/{id}/comprobantes', 'RecibosController@comprobantes');
  Route::post('/TraerEmpleado', 'RecibosController@TraerEmpleado');
  Route::post('/TraerNombreDependencia', 'RecibosController@TraerNombreDependencia');
  Route::post('/create', 'RecibosController@store');
  Route::post('/update', 'RecibosController@update');
  Route::post('/TraerFirmaJefes', 'RecibosController@TraerFirmaJefes');
  Route::post('/TraerJefe', 'RecibosController@TraerJefe');
  Route::post('/TraerJefeDirector', 'RecibosController@TraerJefeDirector');

  Route::get('/tabla', 'RecibosController@tabla');
  Route::get('/{id}/edit', 'RecibosController@edit');
  Route::post('/cancelar', 'RecibosController@cancelar');
  Route::post('/borrar', 'RecibosController@destroy');
  Route::post('/finiquitar', 'RecibosController@finiquitar');
  Route::post('/finiquitarP', 'RecibosController@finiquitarP');
  Route::post('/Turnar', 'RecibosController@Turnar');

  Route::post('/comprobar', 'RecibosController@comprobar');
  Route::post('/tablaComprobacion', 'RecibosController@tablaComprobacion');
  Route::get('/descargar/{name}', 'RecibosController@download');
  Route::delete('/borrarComprobante', 'RecibosController@borrarComprobante');
  Route::get('/especificaciones/{id}/{especificacion}/{comisionado}/{telefono}/{especificar}/{recorrido}/{municipio}/{direccion}', 'RecibosController@especificaciones');
  Route::post('/ConvertirLetras', 'RecibosController@ConvertirLetras');
  Route::post('/TraerGasolina', 'RecibosController@TraerGasolina');
  Route::post('/traerCuotaVehiculo', 'RecibosController@traerCuotaVehiculo');
  Route::post('/TraerPeaje', 'RecibosController@TraerPeaje');
  Route::post('/TraerRecorrido', 'RecibosController@TraerRecorrido');
  Route::post('/AlimentacionTime', 'RecibosController@AlimentacionTime');














});

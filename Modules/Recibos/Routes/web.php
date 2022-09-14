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
  Route::get('/{id}/recibo', 'RecibosController@recibo');
  Route::get('/{id}/oficio', 'RecibosController@oficio');
  Route::get('/especificacion', 'RecibosController@especificacion');
  Route::get('/{id}/especificacioncomision', 'RecibosController@especificacioncomision');
  Route::get('/{id}/imprimir', 'RecibosController@imprimir');
  Route::get('/{id}/comprobantes', 'RecibosController@comprobantes');
  Route::post('/TraerEmpleado', 'RecibosController@TraerEmpleado');
  Route::post('/TraerNombreDependencia', 'RecibosController@TraerNombreDependencia');
  Route::post('/create', 'RecibosController@store');
  Route::post('/update', 'RecibosController@update');
  Route::post('/TraerFirmaJefes', 'RecibosController@TraerFirmaJefes');
  Route::post('/TraerJefe', 'RecibosController@TraerJefe');
  Route::post('/TraerJefeDirector', 'RecibosController@TraerJefeDirector');
  Route::post('/TresZonas', 'RecibosController@TresZonas');
  Route::post('/traerZonaNombre', 'RecibosController@traerZonaNombre');

  Route::get('/tabla', 'RecibosController@tabla');
  Route::get('/{id}/edit', 'RecibosController@edit');
  Route::post('/cancelar', 'RecibosController@cancelar');
  Route::post('/borrar', 'RecibosController@destroy');
  Route::post('/finiquitar', 'RecibosController@finiquitar');
  Route::post('/finiquitarP', 'RecibosController@finiquitarP');
  Route::post('/Turnar', 'RecibosController@Turnar');
  Route::post('/autorizar', 'RecibosController@autorizar');

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
  Route::post('/NivelAlimentacion', 'RecibosController@NivelAlimentacion');
  Route::post('/AlimentacionTime', 'RecibosController@AlimentacionTime');
  Route::post('/borrarVHf', 'RecibosController@borrarVHf');
  Route::post('/borrarVH', 'RecibosController@borrarVH');
  Route::post('/borrarAutob', 'RecibosController@borrarAutob');
  Route::post('/borrarAvion', 'RecibosController@borrarAvion');
  Route::post('/borrarTaxi', 'RecibosController@borrarTaxi');
  Route::post('/borrarPeaje', 'RecibosController@borrarPeaje');
  Route::post('/CambioDias', 'RecibosController@CambioDias');
  Route::post('/TraerDatosViaticoLugar', 'RecibosController@TraerDatosViaticoLugar');
  Route::post('/CambioKilometraje', 'RecibosController@CambioKilometraje');
  Route::post('/TraerBorrarDatosViaticoLugar', 'RecibosController@TraerBorrarDatosViaticoLugar');
  Route::post('/TraerGasolinaDatosViaticoLugar', 'RecibosController@TraerGasolinaDatosViaticoLugar');

  Route::post('/TraerHospedajeDatosViaticoLugar', 'RecibosController@TraerHospedajeDatosViaticoLugar');
  Route::post('/TraerDesayunoDatosViaticoLugar', 'RecibosController@TraerDesayunoDatosViaticoLugar');
  Route::post('/TraerComidaDatosViaticoLugar', 'RecibosController@TraerComidaDatosViaticoLugar');
  Route::post('/TraerCenaDatosViaticoLugar', 'RecibosController@TraerCenaDatosViaticoLugar');
  Route::post('/TraerGasolinaL', 'RecibosController@TraerGasolinaL');
  Route::post('/TraerHospedajeL', 'RecibosController@TraerHospedajeL');
  Route::post('/TraerDesayunoL', 'RecibosController@TraerDesayunoL');
  Route::post('/TraerComidaL', 'RecibosController@TraerComidaL');
  Route::post('/TraerCenaL', 'RecibosController@TraerCenaL');

  Route::post('/Destino', 'RecibosController@Destino');


























});

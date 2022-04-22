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

Route::prefix('catalogos')->group(function() {
    Route::get('/', 'CatalogosController@index');

    Route::prefix('alimentacion')->group(function() {
      Route::get('/', 'AlimentacionController@index');
      Route::get('/create', 'AlimentacionController@create');
      Route::get('/show', 'AlimentacionController@show');
    });

    Route::prefix('hospedaje')->group(function() {
        Route::get('/', 'HospedajeController@index');
        Route::get('/create', 'HospedajeController@create');
        Route::get('/show', 'HospedajeController@show');

    });

    Route::prefix('kilometraje')->group(function() {
        Route::get('/', 'KilometrajeController@index');
        Route::get('/create', 'KilometrajeController@create');
        Route::get('/show', 'KilometrajeController@show');

    });

    Route::prefix('localidades')->group(function() {
        Route::get('/', 'LocalidadesController@index');
        Route::get('/create', 'LocalidadesController@create');
        Route::get('/show', 'LocalidadesController@show');

    });

    Route::prefix('peaje')->group(function() {
        Route::get('/', 'PeajeController@index');
        Route::get('/create', 'PeajeController@create');
        Route::get('/show', 'PeajeController@show');

    });

    Route::prefix('rendimiento')->group(function() {
        Route::get('/', 'RendimientoController@index');
        Route::get('/create', 'RendimientoController@create');
        Route::get('/show', 'RendimientoController@show');

    });

    Route::prefix('taxi')->group(function() {
        Route::get('/', 'TaxiController@index');
        Route::get('/create', 'TaxiController@create');
        Route::get('/show', 'TaxiController@show');

    });

    Route::prefix('gasolina')->group(function() {
        Route::get('/', 'GasolinaController@index');
        Route::get('/create', 'GasolinaController@create');
        Route::get('/show', 'GasolinaController@show');
    });


});

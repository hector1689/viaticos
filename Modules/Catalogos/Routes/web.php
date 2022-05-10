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
      Route::get('/tabla', 'AlimentacionController@tabla');
      Route::get('/create', 'AlimentacionController@create');
      Route::post('/create', 'AlimentacionController@store');
      Route::delete('/borrar', 'AlimentacionController@destroy');
      Route::get('/{id}/edit', 'AlimentacionController@edit');
      Route::post('/update', 'AlimentacionController@update');
      Route::get('/show', 'AlimentacionController@show');
    });

    Route::prefix('hospedaje')->group(function() {
        Route::get('/', 'HospedajeController@index');
        Route::get('/create', 'HospedajeController@create');
        Route::post('/create', 'HospedajeController@store');
        Route::get('/tabla', 'HospedajeController@tabla');
        Route::delete('/borrar', 'HospedajeController@destroy');
        Route::get('/{id}/edit', 'HospedajeController@edit');
        Route::post('/update', 'HospedajeController@update');
        Route::get('/show', 'HospedajeController@show');

    });

    Route::prefix('kilometraje')->group(function() {
        Route::get('/', 'KilometrajeController@index');
        Route::get('/create', 'KilometrajeController@create');
        Route::post('/create', 'KilometrajeController@store');
        Route::get('/tabla', 'KilometrajeController@tabla');
        Route::delete('/borrar', 'KilometrajeController@destroy');
        Route::get('/{id}/edit', 'KilometrajeController@edit');
        Route::post('/update', 'KilometrajeController@update');
        Route::get('/show', 'KilometrajeController@show');

    });

    Route::prefix('localidades')->group(function() {
        Route::get('/', 'LocalidadesController@index');
        Route::get('/create', 'LocalidadesController@create');
        // Route::get('/show', 'LocalidadesController@show');
        Route::get('/tabla', 'LocalidadesController@tabla');
        Route::post('/create', 'LocalidadesController@store');
        Route::delete('/borrar', 'LocalidadesController@destroy');
        Route::get('/{id}/edit', 'LocalidadesController@edit');
        Route::post('/update', 'LocalidadesController@update');
        Route::post('/Estado', 'LocalidadesController@Estado');
        Route::post('/Municipio', 'LocalidadesController@Municipio');

        Route::post('/Estadoedit', 'LocalidadesController@Estadoedit');
        Route::post('/Municipioedit', 'LocalidadesController@Municipioedit');



    });

    Route::prefix('peaje')->group(function() {
        Route::get('/', 'PeajeController@index');
        Route::get('/create', 'PeajeController@create');
        Route::post('/create', 'PeajeController@store');
        Route::get('/tabla', 'PeajeController@tabla');
        Route::delete('/borrar', 'PeajeController@destroy');
        Route::get('/{id}/edit', 'PeajeController@edit');
        Route::post('/update', 'PeajeController@update');
        Route::get('/show', 'PeajeController@show');

    });

    Route::prefix('rendimiento')->group(function() {
        Route::get('/', 'RendimientoController@index');
        Route::get('/create', 'RendimientoController@create');
        Route::post('/create', 'RendimientoController@store');
        Route::get('/tabla', 'RendimientoController@tabla');
        Route::delete('/borrar', 'RendimientoController@destroy');
        Route::get('/{id}/edit', 'RendimientoController@edit');
        Route::post('/update', 'RendimientoController@update');
        Route::get('/show', 'RendimientoController@show');

    });

    Route::prefix('taxi')->group(function() {
        Route::get('/', 'TaxiController@index');
        Route::get('/create', 'TaxiController@create');
        Route::get('/tabla', 'TaxiController@tabla');
        Route::post('/create', 'TaxiController@store');
        Route::delete('/borrar', 'TaxiController@destroy');
        Route::get('/{id}/edit', 'TaxiController@edit');
        Route::post('/update', 'TaxiController@update');
        Route::get('/show', 'TaxiController@show');

    });

    Route::prefix('gasolina')->group(function() {
        Route::get('/', 'GasolinaController@index');
        Route::get('/create', 'GasolinaController@create');
        Route::post('/create', 'GasolinaController@store');
        Route::get('/tabla', 'GasolinaController@tabla');
        Route::delete('/borrar', 'GasolinaController@destroy');
        Route::get('/{id}/edit', 'GasolinaController@edit');
        Route::post('/update', 'GasolinaController@update');
        Route::get('/show', 'GasolinaController@show');
    });

    Route::prefix('folios')->group(function() {
        Route::get('/', 'FolioController@index');
        Route::get('/create', 'FolioController@create');
        Route::get('/show', 'FolioController@show');
    });

    Route::prefix('comisionados')->group(function() {
        Route::get('/', 'ComisionadosController@index');
        Route::get('/create',         'ComisionadosController@create');
        Route::post('/store',	          'ComisionadosController@store');
        Route::get('/{id}/edit', 		  'ComisionadosController@edit');
      //  Route::post ('/borrar', 	  'ComisionadosController@destroy');
        Route::put ('/{id}/reactivar', 	  'ComisionadosController@reactivar');
        Route::put('/{id}', 'ComisionadosController@update');
        Route::get('/tablaEstatus',         'ComisionadosController@tablaEstatus');
        Route::get('buscarPersonas/{query}', 'ComisionadosController@buscarPersonas');
        Route::get('/datos_area/{id}', 'ComisionadosController@datos_area');
        Route::get('/buscaAreas/{id}/{filtra_roles}/{tipo}', 'ComisionadosController@buscaAreas');
        //Route::get('/', 'ComisionadosController@index');
        Route::post('/create_area', 'ComisionadosController@create_area');
        Route::post('/update_area/{id}', 'ComisionadosController@update_area');
        Route::delete('/borrar', 'ComisionadosController@delete_area');
        Route::post('/TraerPersonal', 'ComisionadosController@TraerPersonal');

        Route::post('/NivelEstructura', 'ComisionadosController@NivelEstructura');
        Route::get('/tablaPersonal',         'ComisionadosController@tablaPersonal');

        Route::post('/ExistePersonal',         'ComisionadosController@ExistePersonal');
        Route::post('/AltaPersonal',         'ComisionadosController@AltaPersonal');

        Route::delete ('/destroy', 	        'ComisionadosController@destroy');

        Route::post('/BuscarAreaExistente', 'ComisionadosController@BuscarAreaExistente');


        Route::get('/create', 'ComisionadosController@create');
        Route::get('/show', 'ComisionadosController@show');
    });


});

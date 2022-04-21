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

Route::prefix('bienes')->group(function() {
  Route::get('/', 'BienesController@index');
  Route::get('/create', 'BienesController@create');
  Route::get('/show', 'BienesController@show');
  Route::get('/resguardante', 'BienesController@resguardante');

});

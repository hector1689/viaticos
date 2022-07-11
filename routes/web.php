<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
    //return view('welcome');
   //return view('auth/login');
  //  if (Auth::user()) {
  //   return view('dashboard');
  // }
    return view('auth/login');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
Route::group(["middleware" => ['auth:sanctum', 'verified']], function(){

  Route::resource('dashboard', HomeController::class);
  Route::post('/actualizar' , [HomeController::class, 'actualizar']);
  Route::get('/tabla' , [HomeController::class, 'tabla']);
  Route::post('/TraerDatosCursos', [HomeController::class, 'TraerDatosCursos']);
  Route::post('/datos1', [HomeController::class, 'datos1']);
  Route::post('/datos2', [HomeController::class, 'datos2']);


});

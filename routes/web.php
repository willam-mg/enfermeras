<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AfiliadoController;

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


Auth::routes();


Route::middleware('auth')->group(function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('imprimir-credencial/{id}', [AfiliadoController::class, 'imprimirCredencial']);

});

Route::resource('users', UserController::class)->middleware(['auth']);
Route::resource('afiliados', AfiliadoController::class)->middleware(['auth']);

Route::get('/imagen', function() {
    $image = public_path("img/test.jpg");
    $img = Image::make($image)->resize(50, 50);
    return $img->response('jpg');
});
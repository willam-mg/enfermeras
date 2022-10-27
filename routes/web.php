<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AfiliadoController;
use App\Http\Controllers\AcreditacionController;
use App\Http\Controllers\PagoController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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
    Route::get('imprimir-credencial/{id}/{side?}', [AfiliadoController::class, 'imprimirCredencial']);

});

Route::resource('users', UserController::class)->middleware(['auth']);
Route::resource('afiliados', AfiliadoController::class)->middleware(['auth']);
Route::post('afiliados/requisitos/{id}', [AfiliadoController::class, 'requisitos'])->middleware(['auth']);
Route::resource('acreditaciones', AcreditacionController::class)->middleware(['auth']);
Route::resource('pagos', PagoController::class)->middleware(['auth']);
Route::get('pagos/create/{id}', [PagoController::class, 'store'])->middleware(['auth']);
Route::get('pagos/recibo/{id}', [PagoController::class, 'recibo'])->middleware(['auth']);
Route::get('pagos/recibopdf/{id}', [PagoController::class, 'recibopdf'])->middleware(['auth']);

Route::post('acreditaciones/pagar', [AcreditacionController::class, 'pagar'])->middleware(['auth']);
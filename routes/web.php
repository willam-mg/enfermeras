<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AfiliadoController;
use App\Http\Controllers\AporteController;
use App\Http\Controllers\PagoController;
use App\Http\Livewire\Afiliado\Index as AfiliadoIndex;
use App\Models\Afiliado;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Obsequio\Index as ObsequioIndex;
use App\Http\Livewire\Dashboard\Index as DashboardIndex;
use App\Http\Livewire\User\Index as UserIndex;

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
    Route::get('/', DashboardIndex::class);
    Route::get('/home', DashboardIndex::class)->name('home');
    Route::get('imprimir-credencial/{id}/{side?}', [AfiliadoController::class, 'imprimirCredencial']);
    Route::get('afiliados', AfiliadoIndex::class);
    Route::get('users', UserIndex::class);
});

Route::post('afiliados/requisitos/{id}', [AfiliadoController::class, 'requisitos'])->middleware(['auth']);
Route::resource('aportes', AporteController::class)->middleware(['auth']);
Route::resource('pagos', PagoController::class)->middleware(['auth']);
Route::get('pagos/create/{id}', [PagoController::class, 'store'])->middleware(['auth']);
Route::get('pagos/recibo/{id}', [PagoController::class, 'recibo'])->middleware(['auth']);
Route::get('pagos/recibopdf/{id}', [PagoController::class, 'recibopdf'])->middleware(['auth']);

Route::post('aportes/pagar', [AporteController::class, 'pagar'])->middleware(['auth']);

Route::get('/obsequios', function(){
    return view('obsequio.index');
});
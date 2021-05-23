<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JuegoController;

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

/**
 * Ruta principal: gestión del tablero y las partidas
 * (formato de acceso al controller nuevo en Laravel 8)
 */
Route::get('/', [JuegoController::class, 'showTablero'])->name('tablero');

/**
 * Rutas de acciones del juego
 */
Route::post('/', [JuegoController::class, 'nuevaPartida']);
Route::post('/colocar', [JuegoController::class, 'colocarFicha']);

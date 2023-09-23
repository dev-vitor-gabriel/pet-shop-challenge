<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AtendimentoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AtendimentoController::class)->middleware('jwt.auth')->group(function () {
    Route::post('', 'create');
    Route::get('{id_pet}', 'get');
    Route::get('', 'get');
    Route::put('{id_pet}', 'update');
    Route::delete('{id_pet}', 'delete');
});
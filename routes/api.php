<?php

use App\Http\Controllers\EnviarController;
use App\Http\Controllers\JobPruebaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sendSms', [EnviarController::class, 'enviarSms']);

//conceptmovil.com
Route::post('/envios_masivos', [EnviarController::class, 'enviosMasivos']);


// mensaje dlr
Route::post('/mensaje_dlr', [EnviarController::class, 'mensajeDlr']);
Route::post('/mensaje_error', [EnviarController::class, 'mensajeDlrError']);
Route::post('/mensaje_unknow', [EnviarController::class, 'mensajeDlrUnKnow']);


// Prueba job
Route::post('/job_prueba', [JobPruebaController::class, 'JobPrueba']);

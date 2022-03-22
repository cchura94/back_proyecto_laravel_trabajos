<?php

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
use App\Http\Controllers\Api\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/v1/auth/login", [AuthController::class, "login"]);
Route::post("/v1/auth/registro", [AuthController::class, "registro"]);

Route::middleware('auth:sanctum')->group(function(){
    Route::get("/v1/auth/perfil", [AuthController::class, "perfil"]);
    Route::post("/v1/auth/logout", [AuthController::class, "salir"]);
    // agregar las rutas de manera segura
});

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
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\EmpresaController;
use App\Http\Controllers\Api\PersonaController;
use App\Http\Controllers\Api\PublicacionController;
use App\Http\Controllers\Api\RubroController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/", function(){
    return response()->json(["mensaje" => "Saludos desde la api"]);
});

Route::post("/v1/auth/login", [AuthController::class, "login"]);
Route::post("/v1/auth/registro", [AuthController::class, "registro"]);

Route::middleware('auth:sanctum')->group(function(){

    Route::get("/v1/auth/perfil", [AuthController::class, "perfil"]);
    Route::post("/v1/auth/logout", [AuthController::class, "salir"]);
    // agregar las rutas de manera segura
    Route::apiResource("v1/categoria", CategoriaController::class);
    Route::apiResource("v1/empresa", EmpresaController::class);
    Route::apiResource("v1/publicacion", PublicacionController::class);
    Route::apiResource("v1/rubro", RubroController::class);
    Route::apiResource("v1/persona", PersonaController::class);
    
    Route::get("v1/reporte/publicacion", [PublicacionController::class, "generarPDF"]);
    
});

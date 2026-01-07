<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Ruta temporal para crear las tablas en la nube
Route::get('/instalar-base-de-datos', function () {
    config(['session.driver' => 'array']); // Usar array para evitar base de datos
    try {
        Artisan::call('migrate', ['--force' => true]);
        $output = Artisan::output();
        return "<h1>¡Éxito! Tablas creadas:</h1><pre>" . $output . "</pre>";
    } catch (\Exception $e) {
        return "<h1>Error al crear tablas:</h1><pre>" . $e->getMessage() . "</pre>";
    }
});
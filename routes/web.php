<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LugarTuristicoController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\HospedajeController;
use App\Http\Controllers\TransporteController;
use App\Http\Controllers\EmergenciaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\ResenaController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lugares', [LugarTuristicoController::class, 'index'])
    ->name('lugares.index');

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Lugares turísticos (CRUD)
    Route::get('/lugares/create', [LugarTuristicoController::class, 'create'])
        ->name('lugares.create');

    Route::post('/lugares', [LugarTuristicoController::class, 'store'])
        ->name('lugares.store');

    Route::get('/lugares/{lugar}/edit', [LugarTuristicoController::class, 'edit'])
        ->name('lugares.edit');

    Route::put('/lugares/{lugar}', [LugarTuristicoController::class, 'update'])
        ->name('lugares.update');

    Route::delete('/lugares/{lugar}', [LugarTuristicoController::class, 'destroy'])
        ->name('lugares.destroy');
});
Route::middleware('auth')->group(function () {
    Route::resource('restaurantes', RestauranteController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('hospedajes', HospedajeController::class);
});
Route::middleware('auth')->group(function () {
    Route::resource('transportes', TransporteController::class);
});
Route::middleware('auth')->group(function () {
    Route::resource('emergencias', EmergenciaController::class);
});
Route::middleware('auth')->group(function () {
    Route::resource('eventos', EventoController::class);
});
Route::middleware('auth')->group(function () {

    Route::get('/favoritos', [FavoritoController::class, 'index'])
        ->name('favoritos.index');

    Route::post('/favoritos/{lugar}', [FavoritoController::class, 'store'])
        ->name('favoritos.store');

    Route::delete('/favoritos/{lugar}', [FavoritoController::class, 'destroy'])
        ->name('favoritos.destroy');

});
Route::middleware('auth')->group(function () {
    Route::post('/lugares/{lugar}/resenas', [ResenaController::class, 'store'])
        ->name('resenas.store');
});
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/lugares/create', [LugarTuristicoController::class, 'create'])
        ->name('lugares.create');

    Route::post('/lugares', [LugarTuristicoController::class, 'store'])
        ->name('lugares.store');

    Route::get('/lugares/{lugar}/edit', [LugarTuristicoController::class, 'edit'])
        ->name('lugares.edit');

    Route::put('/lugares/{lugar}', [LugarTuristicoController::class, 'update'])
        ->name('lugares.update');

    Route::delete('/lugares/{lugar}', [LugarTuristicoController::class, 'destroy'])
        ->name('lugares.destroy');

});

/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Ruta temporal para crear las tablas en la nube
Route::get('/instalar-base-de-datos', function () {
    try {
        // Ejecuta las migraciones (crea las tablas)
        Artisan::call('migrate', ['--force' => true]);
        
        $output = Artisan::output();
        return "<h1>¡Éxito! Tablas creadas:</h1><pre>" . $output . "</pre>";
    } catch (\Exception $e) {
        return "<h1>Error al crear tablas:</h1><pre>" . $e->getMessage() . "</pre>";
    }
});
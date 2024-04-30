<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarjetaPersonalController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstanteriaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Usuario no registrado
Route::get('/', function () {
    return view('usuarioNoRegistrado.index');
});

Route::get('/noticias', function () {
    return view('usuarioNoregistrado.noticias');
})->name('noticias');


Route::get('/actividades', function () {
    return view('usuarioNoregistrado.actividades');
})->name('actividades');

route::get('/catalogo', function () {
    return view('usuarioNoregistrado.catalogo');
})->name('catalogo');

route::get('/sobreNosotros', function () {
    return view('usuarioNoregistrado.sobreNosotros');
})->name('sobreNosotros');

Route::get('/tarjetaPersonal', function () {
    return view('usuarioNoregistrado.tarjetaPersonal');
})->name('tarjetaPersonal');

route::get('/horarioCalendario', function () {
    return view('usuarioNoregistrado.horarioCalendario');
})->name('horarioCalendario');



Route::get('/noticias/{noticia}', [NoticiaController::class, 'show'])->name('noticias.show');
Route::get('/noticias-logged/{noticia}', [NoticiaController::class, 'showLogged'])->name('noticias-logged.show');
Route::get('/libros/{libro}', [LibroController::class, 'show'])->name('libros.show');

//Usuario registrado

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
    

    // Rutas para perfiles de usuarios
Route::middleware('auth')->group(function () {
    // Home page para usuarios registrados
    Route::get('/index-logged', function () {
        return view('usuarioLogged.index-logged');
    })->name('index-logged');

    // Perfil del usuario
    Route::resource('users', UserController::class);

    // Rutas para perfiles de usuarios
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas adicionales para la funcionalidad del usuario registrado
    Route::get('/mis-libros', [UserController::class, 'misLibros'])->name('mis-libros');
    Route::get('/libros-logged/{libro}', [LibroController::class, 'showLogged'])->name('libros-logged.show');



    // Tarjeta personal
    Route::get('/tarjetaPersonal-logged', function () {
        return view('usuarioLogged.tarjetaPersonal-logged');
    })->name('tarjetaPersonal-logged');

    // Otras rutas...
    Route::get('/actividades-logged', function () {
        return view('usuarioLogged.actividades-logged');
    })->name('actividades-logged');

    Route::get('/noticias-logged', function () {
        return view('usuarioLogged.noticias-logged');
    })->name('noticias-logged');

    Route::get('/catalogo-logged', function () {
        return view('usuarioLogged.catalogo-logged');
    })->name('catalogo-logged');

    Route::get('/sobreNosotros-logged', function () {
        return view('usuarioLogged.sobreNosotros-logged');
    })->name('sobreNosotros-logged');

    Route::get('/horarioCalendario-logged', function () {
        return view('usuarioLogged.horarioCalendario-logged');
    })->name('horarioCalendario-logged');

    Route::get('/tarjetaPersonal-logged', function () {
        return view('usuarioLogged.tarjetaPersonal-logged');
    })->name('tarjetaPersonal-logged');

    Route::get('/mis-libros', function () {
        return view('usuarioLogged.mis-libros');
    })->name('mis-libros');

    Route::get('/mis-prestamos', function () {
        return view('usuarioLogged.mis-prestamos');
    })->name('mis-prestamos');
    
});

//tarjeta personal logged
Route::middleware('auth')->group(function () {
    Route::get('/tarjetaPersonal-logged', [TarjetaPersonalController::class, 'loggedIndex'])->name('tarjetaPersonal-logged.index');
    Route::post('/tarjetaPersonal-logged', [TarjetaPersonalController::class, 'storeLogged'])->name('tarjetaPersonal-logged.store');
    Route::get('/tarjetaPersonal-logged/create', [TarjetaPersonalController::class, 'createLogged'])->name('tarjetaPersonal-logged.create');
    Route::get('/tarjetaPersonal-logged/{id}/edit', [TarjetaPersonalController::class, 'editLogged'])->name('tarjetaPersonal-logged.edit');
    Route::patch('/tarjetaPersonal-logged/{id}', [TarjetaPersonalController::class, 'updateLogged'])->name('tarjetaPersonal-logged.update');
    Route::delete('/tarjetaPersonal-logged/{id}', [TarjetaPersonalController::class, 'destroyLogged'])->name('tarjetaPersonal-logged.destroy');
});

Route::get('/tarjetaPersonal', [TarjetaPersonalController::class, 'index'])->name('tarjetaPersonal.index');
Route::post('/tarjetaPersonal', [TarjetaPersonalController::class, 'store'])->name('tarjetaPersonal.store');
Route::get('/tarjetaPersonal/create', [TarjetaPersonalController::class, 'create'])->name('tarjetaPersonal.create');
Route::get('/tarjetaPersonal/{id}/edit', [TarjetaPersonalController::class, 'edit'])->name('tarjetaPersonal.edit');
Route::patch('/tarjetaPersonal/{id}', [TarjetaPersonalController::class, 'update'])->name('tarjetaPersonal.update');
Route::delete('/tarjetaPersonal/{id}', [TarjetaPersonalController::class, 'destroy'])->name('tarjetaPersonal.destroy');


/*post*/
Route::post('/tarjetaPersonal', [TarjetaPersonalController::class, 'store'])->name('tarjeta-personal.store');

require __DIR__.'/auth.php';

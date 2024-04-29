<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarjetaPersonalController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


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
Route::get('/libros/{libro}', [NoticiaController::class, 'show'])->name('libros.show');

//Usuario registrado

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
    
    
Route::middleware('auth')->group(function () {
    // Home page para usuarios registrados
    Route::get('/index-logged', function () {
        return view('usuarioLogged.index-logged');
    })->name('index-logged');

    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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

/*post*/
Route::post('/tarjetaPersonal', [TarjetaPersonalController::class, 'store'])->name('tarjeta-personal.store');

require __DIR__.'/auth.php';

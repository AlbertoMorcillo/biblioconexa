<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view('usuarioNoRegistrado.index');
});

Route::get('/noticias', function () {
    return view('usuarioNoregistrado.noticias');
});


Route::get('/actividades', function () {
    return view('usuarioNoregistrado.actividades');
});

route::get('/catalogo', function () {
    return view('usuarioNoregistrado.catalogo');
});

route::get('sobreNosotros', function () {
    return view('usuarioNoregistrado.sobreNosotros');
});

route::get('tarjetaPersonal', function () {
    return view('usuarioNoregistrado.tarjetaPersonal');
});

route::get('horarioCalendario', function () {
    return view('usuarioNoregistrado.horarioCalendario');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

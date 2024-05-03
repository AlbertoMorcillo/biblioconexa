<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    GoogleBooksController,
    ProfileController,
    TarjetaPersonalController,
    Auth\AuthenticatedSessionController,
    LibroController,
    ComentarioController,
    UserController,
    EstanteriaController,
    NoticiaController,
    LibroSugeridoController,
    EventoController,
    EstanteriaLibroController,
    AutorController,
    CategoriaController,
};

// Routes for non-registered users
Route::get('/', function () {
    return view('usuarioNoRegistrado.index');
})->name('home');

Route::view('/noticias', 'usuarioNoRegistrado.noticias')->name('noticias.index');
Route::view('/actividades', 'usuarioNoRegistrado.actividades')->name('actividades');
Route::view('/catalogo', 'usuarioNoRegistrado.catalogo')->name('catalogo');
Route::view('/sobreNosotros', 'usuarioNoRegistrado.sobreNosotros')->name('sobreNosotros');
Route::view('/horarioCalendario', 'usuarioNoRegistrado.horarioCalendario')->name('horarioCalendario');

Route::get('/search', [GoogleBooksController::class, 'search'])->name('search-books');



// Tarjeta Personal routes accessible to both registered and non-registered users
Route::resource('tarjetaPersonal', TarjetaPersonalController::class)
    ->only(['create', 'store', 'index', 'show']);  // Exposing only non-sensitive routes

// Routes for registered users
Route::middleware('auth')->group(function () {
    Route::get('/index-logged', function () {
        return view('usuarioLogged.index-logged');
    })->name('index-logged');

    Route::get('/mis-libros', [UserController::class, 'misLibros'])->name('mis-libros');

    Route::resources([
        'users' => UserController::class,
        'libros' => LibroController::class,
        'autores' => AutorController::class,
        'categorias' => CategoriaController::class,
        'librosSugeridos' => LibroSugeridoController::class,
        'eventos' => EventoController::class,
        'estanterias' => EstanteriaController::class,
        'comentarios' => ComentarioController::class,
        'estanteriasLibros' => EstanteriaLibroController::class,
        
    ]);

    Route::resource('tarjetaPersonal', TarjetaPersonalController::class)
        ->only(['edit', 'update', 'destroy']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('/tarjetaPersonal-logged', 'usuarioLogged.tarjetaPersonal-logged')->name('tarjetaPersonal-logged');
    Route::view('/actividades-logged', 'usuarioLogged.actividades-logged')->name('actividades-logged');
    Route::view('/noticias-logged', 'usuarioLogged.noticias-logged')->name('noticias-logged');
    Route::view('/catalogo-logged', 'usuarioLogged.catalogo-logged')->name('catalogo-logged');
    Route::view('/sobreNosotros-logged', 'usuarioLogged.sobreNosotros-logged')->name('sobreNosotros-logged');
    Route::view('/horarioCalendario-logged', 'usuarioLogged.horarioCalendario-logged')->name('horarioCalendario-logged');

    Route::middleware('can:manage-news')->group(function () {
        Route::get('/noticias/create', [NoticiaController::class, 'create'])->name('noticias.create');
        Route::post('/noticias', [NoticiaController::class, 'store'])->name('noticias.store');
        Route::get('/noticias/{noticia}/edit', [NoticiaController::class, 'edit'])->name('noticias.edit');
        Route::patch('/noticias/{noticia}', [NoticiaController::class, 'update'])->name('noticias.update');
        Route::delete('/noticias/{noticia}', [NoticiaController::class, 'destroy'])->name('noticias.destroy');
    });
});

// Authentication routes
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Include additional authentication routes
require __DIR__.'/auth.php';

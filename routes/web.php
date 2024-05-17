<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PuntuacionController,
    OpenLibraryBooksController,
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

Route::get('/search', [OpenLibraryBooksController::class, 'search'])->name('search-books');

Route::get('/libros/{libro}', [LibroController::class, 'show'])->name('libros.show');
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::delete('/comentarios/{comentario}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');
Route::post('/puntuaciones/{externalId}', [PuntuacionController::class, 'store'])->name('puntuaciones.store');
Route::post('/tarjetaPersonal', [App\Http\Controllers\TarjetaPersonalController::class, 'store'])->name('tarjetaPersonal.store');

// Handling bookshelves and book statuses
Route::middleware('auth')->group(function () {
    Route::get('/estanterias/{user}', [EstanteriaController::class, 'index'])->name('estanterias.index');
    Route::post('/estanterias-libros', [EstanteriaLibroController::class, 'store'])->name('estanteriasLibros.store');
    Route::put('/estanterias-libros/{externalId}', [EstanteriaLibroController::class, 'update'])->name('estanteriasLibros.update');
    Route::get('/mis-libros', [EstanteriaLibroController::class, 'index'])->name('estanteriasLibros.index'); // EstanteriaLibroController maneja la ruta '/mis-libros'
    Route::get('/mis-libros/{externalId}', [EstanteriaLibroController::class, 'show'])->name('estanteriasLibros.show'); // Nueva ruta para mostrar detalles del libro
});

// Routes for registered users
Route::middleware('auth')->group(function () {
    Route::get('/index-logged', function () {
        return view('usuarioLogged.index-logged');
    })->name('index-logged');

    // Ruta conflictiva comentada
    // Route::get('/mis-libros', [UserController::class, 'misLibros'])->name('mis-libros');

    Route::resources([
        'users' => UserController::class,
        'autores' => AutorController::class,
        'categorias' => CategoriaController::class,
        'librosSugeridos' => LibroSugeridoController::class,
        'eventos' => EventoController::class,
        'estanterias' => EstanteriaController::class,
        'comentarios' => ComentarioController::class,
        'estanteriasLibros' => EstanteriaLibroController::class,
    ]);
    Route::resource('tarjetaPersonal', TarjetaPersonalController::class)
        ->only(['index', 'edit', 'update', 'destroy']);
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

// Routes for administrators
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::view('/admin/usuarios', 'admin.usuarios')->name('admin.usuarios');
    Route::view('/admin/libros', 'admin.libros')->name('admin.libros');
    Route::view('/admin/categorias', 'admin.categorias')->name('admin.categorias');
    Route::view('/admin/autores', 'admin.autores')->name('admin.autores');
    Route::view('/admin/noticias', 'admin.noticias')->name('admin.noticias');
    Route::view('/admin/eventos', 'admin.eventos')->name('admin.eventos');
    Route::view('/admin/librosSugeridos', 'admin.librosSugeridos')->name('admin.librosSugeridos');
    Route::view('/admin/estanterias', 'admin.estanterias')->name('admin.estanterias');
    Route::view('/admin/comentarios', 'admin.comentarios')->name('admin.comentarios');
    
});

// Authentication routes
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Include additional authentication routes
require __DIR__.'/auth.php';

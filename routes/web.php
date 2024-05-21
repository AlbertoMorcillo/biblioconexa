<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    PuntuacionController,
    OpenLibraryBooksController,
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/noticias', [NoticiaController::class, 'noticias'])->name('noticias.index');
Route::view('/actividades', 'usuarioNoRegistrado.actividades')->name('actividades');
Route::view('/catalogo', 'usuarioNoRegistrado.catalogo')->name('catalogo');
Route::view('/sobreNosotros', 'usuarioNoRegistrado.sobreNosotros')->name('sobreNosotros');
Route::view('/horarioCalendario', 'usuarioNoRegistrado.horarioCalendario')->name('horarioCalendario');
Route::get('/search', [OpenLibraryBooksController::class, 'search'])->name('search-books');
Route::get('/libros/{libro}', [LibroController::class, 'show'])->name('libros.show');
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::delete('/comentarios/{comentario}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');
Route::post('/puntuaciones/{externalId}', [PuntuacionController::class, 'store'])->name('puntuaciones.store');

// Ruta para la tarjeta personal (accesible tanto para usuarios no autenticados como autenticados)
Route::view('/tarjetaPersonal', 'usuarioNoRegistrado.tarjetaPersonal')->name('tarjetaPersonal');
Route::post('/tarjetaPersonal', [TarjetaPersonalController::class, 'store'])->name('tarjetaPersonal.store');

// Ruta para mostrar el detalle de una noticia
Route::get('/noticias/{noticia}', [NoticiaController::class, 'show'])->name('noticias.show');

// Handling bookshelves and book statuses
Route::middleware('auth')->group(function () {
    Route::get('/estanterias/{user}', [EstanteriaController::class, 'index'])->name('estanterias.index');
    Route::post('/estanterias-libros', [EstanteriaLibroController::class, 'store'])->name('estanteriasLibros.store');
    Route::put('/estanterias-libros/{externalId}', [EstanteriaLibroController::class, 'update'])->name('estanteriasLibros.update');
    Route::get('/mis-libros', [EstanteriaLibroController::class, 'index'])->name('estanteriasLibros.index');
    Route::get('/mis-libros/{externalId}', [EstanteriaLibroController::class, 'show'])->name('estanteriasLibros.show');
});

// Routes for registered users
Route::middleware('auth')->group(function () {
    Route::get('/index-logged', [HomeController::class, 'indexLogged'])->name('index-logged');

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
        ->only(['edit', 'update', 'destroy']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('/tarjetaPersonal-logged', 'usuarioLogged.tarjetaPersonal-logged')->name('tarjetaPersonal-logged');
    Route::view('/actividades-logged', 'usuarioLogged.actividades-logged')->name('actividades-logged');
    Route::get('/noticias-logged', [NoticiaController::class, 'noticiasLogged'])->name('noticias-logged');
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
    Route::get('/admin', [HomeController::class, 'adminIndex'])->name('admin.index');

    Route::get('/admin/usuarios', [UserController::class, 'index'])->name('admin.usuarios.index');
    Route::get('/admin/usuarios/create', [UserController::class, 'create'])->name('admin.usuarios.create');
    Route::post('/admin/usuarios', [UserController::class, 'store'])->name('admin.usuarios.store');
    Route::get('/admin/usuarios/{user}/edit', [UserController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/admin/usuarios/{user}', [UserController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('/admin/usuarios/{user}', [UserController::class, 'destroy'])->name('admin.usuarios.destroy');

    Route::view('/admin/libros', 'admin.libros')->name('admin.libros');
    Route::view('/admin/categorias', 'admin.categorias')->name('admin.categorias');
    Route::view('/admin/autores', 'admin.autores')->name('admin.autores');
    Route::view('/admin/actividades', 'admin.actividades')->name('admin.actividades');
    Route::view('/admin/librosSugeridos', 'admin.librosSugeridos')->name('admin.librosSugeridos');
    Route::view('/admin/estanterias', 'admin.estanterias')->name('admin.estanterias');
    Route::view('/admin/comentarios', 'admin.comentarios')->name('admin.comentarios');
    Route::view('/admin/tarjetaPersonal', 'admin.tarjetaPersonal')->name('admin.tarjetaPersonal');
    Route::view('/admin/mis-libros', 'admin.mis-libros')->name('admin.mis-libros');
    Route::view('/admin/sobreNosotros', 'admin.sobreNosotros')->name('admin.sobreNosotros');
    Route::view('/admin/horarioCalendario', 'admin.horarioCalendario')->name('admin.horarioCalendario');
    Route::view('/admin/catalogo', 'admin.catalogo')->name('admin.catalogo');

    Route::get('/admin/noticias', [NoticiaController::class, 'index'])->name('admin.noticias.index');
    Route::get('/admin/noticias/create', [NoticiaController::class, 'create'])->name('admin.noticias.create');
    Route::post('/admin/noticias', [NoticiaController::class, 'store'])->name('admin.noticias.store');
    Route::get('/admin/noticias/{noticia}/edit', [NoticiaController::class, 'edit'])->name('admin.noticias.edit');
    Route::patch('/admin/noticias/{noticia}', [NoticiaController::class, 'update'])->name('admin.noticias.update');
    Route::delete('/admin/noticias/{noticia}', [NoticiaController::class, 'destroy'])->name('admin.noticias.destroy');
});

// Authentication routes
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Include additional authentication routes
require __DIR__.'/auth.php';

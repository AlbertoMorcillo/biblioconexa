<?php

namespace App\Http\Controllers;
use App\Models\Libro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;


class LibroController extends Controller
{
    public function show($id)
    {
        // Recupera el libro y sus comentarios asociados
        $libro = Libro::with('comentarios.usuario')->findOrFail($id);


            // Devuelve la vista para usuarios no autenticados sin la capacidad de añadir comentarios
            return view('libros.show', compact('libro'));

    }

    public function storeComentario(Request $request, $libroId)
    {
        $request->validate([
            'texto' => 'required|string',
            'puntuacion' => 'required|numeric|min:1|max:5',
        ]);

        // Crea un nuevo comentario y lo asocia al usuario y al libro correspondientes
        $comentario = new Comentario;
        $comentario->usuario_id = Auth::id();
        $comentario->libro_id = $libroId;
        $comentario->texto = $request->texto;
        $comentario->puntuacion = $request->puntuacion;
        $comentario->fechaCreacion = now();
        $comentario->save();

        // Redirige de vuelta con un mensaje de éxito
        return back()->with('success', 'Opinión guardada correctamente.');
    }

    public function showLogged($id)
{
    // Recupera el libro con comentarios y el usuario asociado a cada comentario
    $libro = Libro::with('comentarios.usuario')->findOrFail($id);

    // Devuelve la vista para usuarios autenticados con la capacidad de añadir comentarios
    return view('libros.show-logged', compact('libro'));
}
}

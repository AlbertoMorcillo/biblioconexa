<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{

    public function index()
    {
        // Carga todos los comentarios junto con la información del usuario asociado
        $comentarios = Comentario::with('usuario')->get();

        if (auth()->check()) {
            // Muestra la vista para usuarios registrados
            return view('libros.detalle-logged', ['comentarios' => $comentarios]);
        } else {
            // Muestra la vista para usuarios no registrados
            return view('libros.detalle', ['comentarios' => $comentarios]);
        }
    }



    public function store(Request $request)
    {
        $request->validate([
            'external_id' => 'required|string',  // ID externo del libro de Open Library
            'texto' => 'required|string'        // Texto del comentario
        ]);

        // Crea un nuevo comentario asociado al usuario actual
        Comentario::create([
            'user_id' => Auth::id(),                 // ID del usuario autenticado
            'external_id' => $request->external_id,  // ID externo proporcionado en el formulario
            'texto' => $request->texto              // Texto del comentario
        ]);

        // Redirect back to the book's detail page with success message
        return redirect()->route('libros.show', ['libro' => $request->external_id])
            ->with('success', 'Comentario agregado con éxito.');
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);

        if (Auth::id() !== $comentario->user_id) {
            return back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $comentario->delete();

        return back()->with('success', 'Comentario eliminado con éxito.');
    }
}


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
        return view('comentarios.index', compact('comentarios'));
    }
    
    public function store(Request $request)
    {
        // Valida que los campos necesarios están presentes y son correctos
        $request->validate([
            'external_id' => 'required|string', // ID externo del libro de Open Library
            'texto' => 'required|string'        // Texto del comentario
        ]);

        // Crea un nuevo comentario asociado al usuario actual
        Comentario::create([
            'user_id' => Auth::id(),              // ID del usuario autenticado
            'external_id' => $request->external_id, // ID externo proporcionado en el formulario
            'texto' => $request->texto           // Texto del comentario
        ]);

        // Redirecciona al índice de comentarios con un mensaje de éxito
        return redirect()->route('comentarios.index')->with('success', 'Comentario agregado con éxito.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstanteriasLibros; // Modelo que representa la tabla intermedia
use Illuminate\Support\Facades\Auth;

class EstanteriaController extends Controller
{
    public function cambiarEstado(Request $request, $estanteriaId, $libroId)
    {
        // Asegúrate de que el usuario actual es el propietario de la estantería
        // y que el libro existe y está en la estantería especificada.

        $validatedData = $request->validate([
            'estado' => 'required|in:leyendo,leidos,quieroLeer,dropped',
        ]);

        // Encuentra la relación entre la estantería y el libro
        $estanteriasLibros = EstanteriasLibros::where('EstanteriasID', $estanteriaId)
                            ->where('LibroID', $libroId)
                            ->firstOrFail();

        // Cambia el estado y guarda
        $estanteriasLibros->estado = $validatedData['estado'];
        $estanteriasLibros->save();

        // Redirige con un mensaje de éxito
        return back()->with('success', 'El estado del libro ha sido actualizado.');
    }

    public function eliminarLibro($estanteriaId, $libroId)
    {
        // Encuentra la relación entre la estantería y el libro y la elimina
        $estanteriasLibros = EstanteriasLibros::where('EstanteriasID', $estanteriaId)
                            ->where('LibroID', $libroId)
                            ->firstOrFail();

        $estanteriasLibros->delete();

        // Redirige con un mensaje de éxito
        return back()->with('success', 'El libro ha sido eliminado de la estantería.');
    }
}

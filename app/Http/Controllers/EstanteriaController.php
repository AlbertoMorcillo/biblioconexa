<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstanteriasLibros; // Modelo que representa la tabla intermedia
use Illuminate\Support\Facades\Auth;


class EstanteriaController extends Controller
{
    public function cambiarEstado(Request $request, $estanteriaId, $libroId)
    {
        $validatedData = $request->validate([
            'estado' => 'required|in:leyendo,leidos,quieroLeer,dropped',
        ]);
    
        try {
            $estanteriasLibros = EstanteriasLibros::where('EstanteriasID', $estanteriaId)
                                ->where('LibroID', $libroId)
                                ->firstOrFail();
    
            if ($estanteriasLibros->estanteria->UsuarioDNI !== Auth::id()) {
                return back()->with('error', 'No tienes permiso para cambiar el estado de este libro.');
            }
    
            $estanteriasLibros->estado = $validatedData['estado'];
            $estanteriasLibros->save();
    
            return back()->with('success', 'El estado del libro ha sido actualizado.');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo actualizar el estado del libro.');
        }
    }
    
    public function eliminarLibro($estanteriaId, $libroId)
    {
        try {
            $estanteriasLibros = EstanteriasLibros::where('EstanteriasID', $estanteriaId)
                                ->where('LibroID', $libroId)
                                ->firstOrFail();
    
            if ($estanteriasLibros->estanteria->UsuarioDNI !== Auth::id()) {
                return back()->with('error', 'No tienes permiso para eliminar este libro.');
            }
    
            $estanteriasLibros->delete();
            return back()->with('success', 'El libro ha sido eliminado de la estantería.');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo eliminar el libro.');
        }
    }
    
}

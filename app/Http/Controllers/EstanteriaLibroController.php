<?php

namespace App\Http\Controllers;

use App\Models\EstanteriaLibro; // Modelo en singular
use App\Models\Estanteria;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EstanteriaLibroController extends Controller
{
    public function index()
    {
        $estanteriasLibros = EstanteriaLibro::with(['estanteria', 'libro'])->get();
        return view('estanteriasLibros.index', compact('estanteriasLibros'));
    }

    public function create()
    {
        $estanterias = Estanteria::all();
        $libros = Libro::all();
        return view('estanteriasLibros.create', compact('estanterias', 'libros'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'estanteria_id' => 'required|exists:estanterias,id',
            'external_id' => 'required' 
        ]);
    
        EstanteriaLibro::create([
            'estanteria_id' => $validatedData['estanteria_id'],
            'external_id' => $validatedData['external_id'],
            'estado' => 'sinEstado' 
        ]);
    
        return redirect()->route('estanteriasLibros.index')->with('success', 'Libro añadido a la estantería exitosamente.');
    }
    
    public function update(Request $request, $externalId)
    {
        $validatedData = $request->validate([
            'estado' => 'required|in:leyendo,leidos,quieroLeer,abandonado,sinEstado'
        ]);
    
        // Obtiene el ID de la estantería basada en el estado y el usuario
        $estanteria = Estanteria::where('user_id', auth()->id())->firstOrCreate([
            'user_id' => auth()->id(),
            'nombre' => $validatedData['estado']
        ]);
    
        // Primero, intenta eliminar cualquier estado existente para este libro y usuario
        EstanteriaLibro::where('external_id', $externalId)
                       ->whereHas('estanteria', function ($query) {
                           $query->where('user_id', auth()->id());
                       })->delete();
    
        // Ahora, crea un nuevo registro con el estado actualizado
        EstanteriaLibro::create([
            'external_id' => $externalId,
            'estanteria_id' => $estanteria->id,
            'estado' => $validatedData['estado']
        ]);
    
        return redirect()->route('libros.show', $externalId)->with('success', 'Estado del libro actualizado con éxito.');
    }
    
    

    public function destroy(EstanteriaLibro $estanteriaLibro)
    {
        $estanteriaLibro->delete();
        return redirect()->route('estanteriasLibros.index')->with('success', 'Libro eliminado de la estantería exitosamente.');
    }
}

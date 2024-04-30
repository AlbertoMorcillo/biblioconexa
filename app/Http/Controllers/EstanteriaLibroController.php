<?php

namespace App\Http\Controllers;

use App\Models\EstanteriaLibro; // Modelo en singular
use App\Models\Estanteria;
use App\Models\Libro;
use Illuminate\Http\Request;

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
            'libro_id' => 'required|exists:libros,id'
        ]);

        EstanteriaLibro::create($validatedData);
        return redirect()->route('estanteriasLibros.index')->with('success', 'Libro añadido a la estantería exitosamente.');
    }

    public function destroy(EstanteriaLibro $estanteriaLibro)
    {
        $estanteriaLibro->delete();
        return redirect()->route('estanteriasLibros.index')->with('success', 'Libro eliminado de la estantería exitosamente.');
    }
}

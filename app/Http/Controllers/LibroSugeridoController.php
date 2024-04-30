<?php

namespace App\Http\Controllers;

use App\Models\LibroSugerido;
use Illuminate\Http\Request;

class LibroSugeridoController extends Controller
{
    public function index()
    {
        $librosSugeridos = LibroSugerido::all();
        return view('librosSugeridos.index', ['librosSugeridos' => $librosSugeridos]);
    }

    public function create()
    {
        return view('librosSugeridos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:13',
            'idioma' => 'required|string|max:50',
            'recomendacion' => 'required|string',
            'fechaSugerencia' => 'required|date'
        ]);

        $libroSugerido = new LibroSugerido($request->all());
        $libroSugerido->save();

        return redirect()->route('librosSugeridos.index')->with('success', 'Libro sugerido creado correctamente.');
    }

    public function show(LibroSugerido $libroSugerido)
    {
        return view('librosSugeridos.show', compact('libroSugerido'));
    }

    public function edit(LibroSugerido $libroSugerido)
    {
        return view('librosSugeridos.edit', compact('libroSugerido'));
    }

    public function update(Request $request, LibroSugerido $libroSugerido)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:13',
            'idioma' => 'required|string|max:50',
            'recomendacion' => 'required|string',
            'fechaSugerencia' => 'required|date'
        ]);

        $libroSugerido->update($request->all());

        return redirect()->route('librosSugeridos.index')->with('success', 'Libro sugerido actualizado correctamente.');
    }

    public function destroy(LibroSugerido $libroSugerido)
    {
        $libroSugerido->delete();
        return redirect()->route('librosSugeridos.index')->with('success', 'Libro sugerido eliminado correctamente.');
    }
}

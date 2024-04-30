<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::all();
        return view('autores.index', compact('autores'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'fecha_de_nacimiento' => 'nullable|date',
            'fecha_de_fallecimiento' => 'nullable|date',
            'lugar_de_nacimiento' => 'nullable|string|max:255',
            'nacionalidad' => 'nullable|string|max:100',
            'biografia' => 'nullable',
            'imagen' => 'nullable|url'
        ]);

        Autor::create($validated);
        return redirect()->route('autores.index')->with('success', 'Autor creado con éxito.');
    }

    public function show(Autor $autor)
    {
        return view('autores.show', compact('autor'));
    }

    public function edit(Autor $autor)
    {
        return view('autores.edit', compact('autor'));
    }

    public function update(Request $request, Autor $autor)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'fecha_de_nacimiento' => 'nullable|date',
            'fecha_de_fallecimiento' => 'nullable|date',
            'lugar_de_nacimiento' => 'nullable|string|max:255',
            'nacionalidad' => 'nullable|string|max:100',
            'biografia' => 'nullable',
            'imagen' => 'nullable|url'
        ]);

        $autor->update($validated);
        return redirect()->route('autores.index')->with('success', 'Autor actualizado con éxito.');
    }

    public function destroy(Autor $autor)
    {
        $autor->delete();
        return redirect()->route('autores.index')->with('success', 'Autor eliminado con éxito.');
    }
}

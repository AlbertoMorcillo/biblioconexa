<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:50|unique:categoria,nombre',
            'slug' => 'required|max:60|unique:categoria,slug',
            'descripcion' => 'nullable|string|max:255'
        ]);

        Categoria::create($validated);
        return redirect()->route('categorias.index')->with('success', 'Categoría creada con éxito.');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:50|unique:categoria,nombre,' . $categoria->id,
            'slug' => 'required|max:60|unique:categoria,slug,' . $categoria->id,
            'descripcion' => 'nullable|string|max:255'
        ]);

        $categoria->update($validated);
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada con éxito.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada con éxito.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Estanteria;
use Illuminate\Http\Request;

class EstanteriaController extends Controller
{
    // Muestra todas las estanterías
    public function index()
    {
        $estanterias = Estanteria::all();
        return view('estanterias.index', ['estanterias' => $estanterias]);
    }

    // Muestra el formulario para crear una nueva estantería
    public function create()
    {
        return view('estanterias.create');
    }

    // Almacena una nueva estantería en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);
    
        $estanteria = new Estanteria($request->all());
        $estanteria->user_id = auth()->id(); // Asegurarse de que la estantería esté vinculada al usuario autenticado
        $estanteria->save();
    
        return redirect()->route('estanterias.index')->with('success', 'Estantería creada con éxito.');
    }

    // Muestra una estantería específica
    public function show(Estanteria $estanteria)
    {
        return view('estanterias.show', compact('estanteria'));
    }

    // Muestra el formulario para editar una estantería
    public function edit(Estanteria $estanteria)
    {
        return view('estanterias.edit', compact('estanteria'));
    }

    public function update(Request $request, Estanteria $estanteria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);
    
        $estanteria->update($request->all());
    
        return redirect()->route('estanterias.index')->with('success', 'Estantería actualizada con éxito.');
    }

    // Elimina una estantería
    public function destroy(Estanteria $estanteria)
    {
        $estanteria->delete();

        return redirect()->route('estanterias.index')->with('success', 'Estantería eliminada con éxito.');
    }
}

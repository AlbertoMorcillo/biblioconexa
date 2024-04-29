<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estanterias; // Asegúrate de que este modelo exista en tu directorio de modelos

class EstanteriaController extends Controller
{
    // Muestra una lista de las estanterías
    public function index()
    {
        $estanterias = Estanterias::all();
        return view('estanterias.index', compact('estanterias'));
    }

    // Muestra el formulario para crear una nueva estantería
    public function create()
    {
        return view('estanterias.create');
    }

    // Almacena una nueva estantería en la base de datos
    public function store(Request $request)
    {
        $estanteria = Estanterias::create($request->all());
        return redirect()->route('estanterias.index');
    }

    // Muestra una estantería específica
    public function show(Estanterias $estanteria)
    {
        return view('estanterias.show', compact('estanteria'));
    }

    // Muestra el formulario para editar una estantería existente
    public function edit(Estanterias $estanteria)
    {
        return view('estanterias.edit', compact('estanteria'));
    }

    // Actualiza una estantería existente en la base de datos
    public function update(Request $request, Estanterias $estanteria)
    {
        $estanteria->update($request->all());
        return redirect()->route('estanterias.index');
    }

    // Elimina una estanteria existente de la base de datos
    public function destroy(Estanterias $estanteria)
    {
        $estanteria->delete();
        return redirect()->route('estanterias.index');
    }
}
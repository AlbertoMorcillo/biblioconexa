<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    // Muestra todos los eventos
    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', ['eventos' => $eventos]);
    }

    // Muestra el formulario para crear un nuevo evento
    public function create()
    {
        return view('eventos.create');
    }

    // Almacena un nuevo evento en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required',
            'sala' => 'string|nullable',
            'UsuarioDNI' => 'required|string|max:9'
        ]);

        $evento = new Evento($request->all());
        $evento->save();

        return redirect()->route('eventos.index')->with('success', 'Evento creado correctamente.');
    }

    // Muestra un evento específico
    public function show(Evento $evento)
    {
        return view('eventos.show', compact('evento'));
    }

    // Muestra el formulario para editar un evento
    public function edit(Evento $evento)
    {
        return view('eventos.edit', compact('evento'));
    }

    // Actualiza un evento en la base de datos
    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required',
            'sala' => 'string|nullable',
            'UsuarioDNI' => 'required|string|max:9'
        ]);

        $evento->update($request->all());

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado correctamente.');
    }

    // Elimina un evento
    public function destroy(Evento $evento)
    {
        $evento->delete();

        return redirect()->route('eventos.index')->with('success', 'Evento eliminado correctamente.');
    }
}

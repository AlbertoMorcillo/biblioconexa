<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::paginate(6);
        return view('admin.eventos.index', compact('eventos'));
    }

    public function create()
    {
        $usuarioDNI = Auth::user()->dni;
        return view('admin.eventos.create', compact('usuarioDNI'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|min:5|max:255',
            'descripcion' => 'required|string|min:20',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'sala' => 'nullable|string|max:255',
            'UsuarioDNI' => 'required|string|max:9',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $evento = new Evento();
        $evento->titulo = $request->input('titulo');
        $evento->descripcion = $request->input('descripcion');
        $evento->fecha = $request->input('fecha');
        $evento->hora = $request->input('hora');
        $evento->sala = $request->input('sala');
        $evento->UsuarioDNI = $request->input('UsuarioDNI');
        $evento->user_id = Auth::id();

        if ($request->hasFile('imagen')) {
            $evento->imagen = $request->file('imagen')->store('eventos', 'public');
        }

        $evento->save();

        return redirect()->route('admin.eventos.index')->with('success', 'Evento creado correctamente.');
    }

    public function show(Evento $evento)
    {
        return view('admin.eventos.show', compact('evento'));
    }

    public function edit(Evento $evento)
    {
        return view('admin.eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'sala' => 'nullable|string|max:255',
            'UsuarioDNI' => 'required|string|max:9',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $evento->titulo = $request->input('titulo');
        $evento->descripcion = $request->input('descripcion');
        $evento->fecha = $request->input('fecha');
        $evento->hora = $request->input('hora');
        $evento->sala = $request->input('sala');
        $evento->UsuarioDNI = $request->input('UsuarioDNI');

        if ($request->hasFile('imagen')) {
            if ($evento->imagen) {
                Storage::disk('public')->delete($evento->imagen);
            }
            $evento->imagen = $request->file('imagen')->store('eventos', 'public');
        }

        $evento->save();

        return redirect()->route('admin.eventos.index')->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Evento $evento)
    {
        if ($evento->imagen) {
            Storage::disk('public')->delete($evento->imagen);
        }

        $evento->delete();

        return redirect()->route('admin.eventos.index')->with('success', 'Evento eliminado correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function index()
    {
        $comentarios = Comentario::with(['usuario', 'libro'])->get();
        return view('comentarios.index', compact('comentarios'));
    }

    public function create()
    {
        $libros = Libro::all();
        return view('comentarios.create', compact('libros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'LibroID' => 'required|exists:libros,id',
            'texto' => 'required|string'
        ]);

        Comentario::create([
            'user_id' => Auth::id(),
            'LibroID' => $request->LibroID,
            'texto' => $request->texto
        ]);

        return redirect()->route('comentarios.index')->with('success', 'Comentario agregado con éxito.');
    }

    public function show(Comentario $comentario)
    {
        return view('comentarios.show', compact('comentario'));
    }

    public function edit(Comentario $comentario)
    {
        $libros = Libro::all();
        return view('comentarios.edit', compact('comentario', 'libros'));
    }

    public function update(Request $request, Comentario $comentario)
    {
        $request->validate([
            'LibroID' => 'required|exists:libros,id',
            'texto' => 'required|string'
        ]);

        $comentario->update($request->all());
        return redirect()->route('comentarios.index')->with('success', 'Comentario actualizado con éxito.');
    }

    public function destroy(Comentario $comentario)
    {
        $comentario->delete();
        return redirect()->route('comentarios.index')->with('success', 'Comentario eliminado con éxito.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::all(); // Asegúrate de que la variable esté en plural si esperas múltiples entradas
        return view('noticias.index', compact('noticias')); // Ahora sí compacts correctamente la variable
    }


    public function create()
    {
        return view('noticias.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'publicado' => 'sometimes|boolean',
            'imagen' => 'sometimes|image|max:2048'
        ]);
    
        $noticia = Noticia::create($validatedData);
    
        return redirect()->route('noticias.index')->with('success', 'Noticia creada con éxito.');
    }

    public function show(Noticia $noticia)
{
    return view('noticias.show', compact('noticia'));
}

public function edit(Noticia $noticia)
{
    return view('noticias.edit', compact('noticia'));
}

public function update(Request $request, Noticia $noticia)
{
    $validatedData = $request->validate([
        'titulo' => 'required|max:255',
        'descripcion' => 'required',
        'fecha' => 'required|date',
        'publicado' => 'sometimes|boolean',
        'imagen' => 'sometimes|image|max:2048'
    ]);

    $noticia->update($validatedData);

    return redirect()->route('noticias.index')->with('success', 'Noticia actualizada con éxito.');
}

public function destroy(Noticia $noticia)
{
    $noticia->delete();

    return redirect()->route('noticias.index')->with('success', 'Noticia eliminada con éxito.');
}

}


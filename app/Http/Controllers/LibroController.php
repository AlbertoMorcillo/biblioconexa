<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Libro::with('categoria', 'autores')->get();
        return view('libros.index', compact('libros'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('libros.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required|unique:libros,isbn|max:13',
            'titulo' => 'required|max:255',
            'sinopsis' => 'required',
            'puntuacion' => 'nullable|numeric|between:0,5',
            'cantidad' => 'required|integer',
            'categoriaID' => 'required|exists:categorias,id'
        ]);

        Libro::create($request->all());
        return redirect()->route('libros.index')->with('success', 'Libro creado exitosamente.');
    }

    public function show($libro)
    {
        $client = new Client();
        try {
            $client = new Client();
            $response = $client->request('GET', "https://openlibrary.org/works/$libro.json");
            $bookDetails = json_decode($response->getBody()->getContents(), true);
            $book = [
                'title' => $bookDetails['title'],
                'authors' => array_column($bookDetails['authors'], 'name'), // Suponiendo que 'authors' es un array de arrays con 'name'
                'description' => $bookDetails['description']['value'] ?? 'Descripción no disponible.',
                'cover_url' => "https://covers.openlibrary.org/b/id/{$bookDetails['covers'][0]}-L.jpg"
            ];
    
            return view('libros.detalle', ['book' => $book]);
        } catch (\Exception $e) {
            return back()->withErrors('Error al recuperar los detalles del libro.');
        }
    }
    
    
    


    public function edit(Libro $libro)
    {
        $categorias = Categoria::all();
        return view('libros.edit', compact('libro', 'categorias'));
    }

    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'isbn' => 'required|max:13|unique:libros,isbn,' . $libro->id,
            'titulo' => 'required|max:255',
            'sinopsis' => 'required',
            'puntuacion' => 'nullable|numeric|between:0,5',
            'cantidad' => 'required|integer',
            'categoriaID' => 'required|exists:categorias,id'
        ]);

        $libro->update($request->all());
        return redirect()->route('libros.index')->with('success', 'Libro actualizado exitosamente.');
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();
        return redirect()->route('libros.index')->with('success', 'Libro eliminado exitosamente.');
    }
}

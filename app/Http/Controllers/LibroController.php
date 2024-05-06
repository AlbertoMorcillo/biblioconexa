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
        $response = $client->request('GET', "https://openlibrary.org/works/$libro.json");
        $bookDetails = json_decode($response->getBody()->getContents(), true);

        $book = [
            'title' => $bookDetails['title'],
            'authors' => array_column($bookDetails['authors'], 'name'), // Asegúrate que 'authors' está presente como esperado
            'description' => $this->cleanDescription($bookDetails['description']['value'] ?? 'Descripción no disponible.'),
            'cover_url' => "https://covers.openlibrary.org/b/id/{$bookDetails['covers'][0]}-L.jpg",
            'rating' => $bookDetails['ratings_average'] ?? 'No disponible'
        ];

        $view = auth()->check() ? 'libros.detalle-logged' : 'libros.detalle';
        return view($view, ['book' => $book]);
    } catch (\Exception $e) {
        return back()->withErrors('Error al recuperar los detalles del libro: ' . $e->getMessage());
    }
}

    
    private function cleanDescription($description)
{
  
    $description = preg_replace('/\[(.*?)\]\(.*?\)/', '$1', $description);
    $description = preg_replace('/\bhttps?:\/\/\S+/i', '', $description);

    return $description;
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

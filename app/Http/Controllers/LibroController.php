<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    
            // Default cover image if none exists
            $defaultCoverUrl = asset('images/libros/default_cover.jpg');
    
            // Extracting author information
            $authors = 'Autor no disponible';
            if (isset($bookDetails['authors']) && is_array($bookDetails['authors'])) {
                $authorKeys = array_column($bookDetails['authors'], 'author');
                $authorNames = [];
                foreach ($authorKeys as $key) {
                    $authorResponse = $client->request('GET', 'https://openlibrary.org' . $key['key'] . '.json');
                    $authorDetails = json_decode($authorResponse->getBody()->getContents(), true);
                    $authorNames[] = $authorDetails['name'] ?? 'Nombre no disponible';
                }
                $authors = implode(', ', $authorNames);
            }
    
            // Accessing description safely
            $description = isset($bookDetails['description']['value'])
                            ? $this->cleanDescription($bookDetails['description']['value'])
                            : 'Descripción no disponible';
    
            // Use first cover if available
            $coverUrl = isset($bookDetails['covers'][0])
                        ? "https://covers.openlibrary.org/b/id/{$bookDetails['covers'][0]}-L.jpg"
                        : $defaultCoverUrl;
    
            // There's no ratings_average in your example JSON, you might need to handle it based on your API or set a default
            $rating = 'No disponible';
    
            $book = [
                'title' => $bookDetails['title'] ?? 'Título no disponible',
                'authors' => $authors,
                'description' => $description,
                'cover_url' => $coverUrl,
                'rating' => $rating
            ];
    
            $view = Auth::check() ? 'libros.detalle-logged' : 'libros.detalle';
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

<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Comentario;

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

            $defaultCoverUrl = asset('images/libros/default_cover.jpg');
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

            $description = isset($bookDetails['description']['value'])
                            ? $this->cleanDescription($bookDetails['description']['value'])
                            : 'Descripción no disponible';

            $coverUrl = isset($bookDetails['covers'][0])
                        ? "https://covers.openlibrary.org/b/id/{$bookDetails['covers'][0]}-L.jpg"
                        : $defaultCoverUrl;

            $rating = 'No disponible';

            // Fetch comments from the database using the external_id
            $comentarios = Comentario::where('external_id', $libro)->get();

            $book = [
                'title' => $bookDetails['title'] ?? 'Título no disponible',
                'authors' => $authors,
                'description' => $description,
                'cover_url' => $coverUrl,
                'rating' => $rating,
                'comentarios' => $comentarios,
                'external_id' => $libro 
            ];

            $view = Auth::check() ? 'libros.detalle-logged' : 'libros.detalle';
            return view($view, ['book' => $book]);
        } catch (\Exception $e) {
            return back()->withErrors('Error al recuperar los detalles del libro: ' . $e->getMessage());
        }
    }
    private function cleanDescription($description)
    {

         // Elimina enlaces en formato Markdown
        $description = preg_replace('/\[(.*?)\]\(.*?\)/', '$1', $description);
        // Elimina enlaces directos en formato HTML
        $description = preg_replace('/\bhttps?:\/\/\S+/i', '', $description);
        //Intenta limpiar referencias residuales
        $description = preg_replace('/\[\w+\]\[\d+\]/', '', $description);

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

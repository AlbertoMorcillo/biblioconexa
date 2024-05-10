<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Comentario;
use Illuminate\Support\Facades\DB;

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
            // Obtención de datos del libro de Open Library o cualquier otra fuente.
            $response = $client->request('GET', "https://openlibrary.org/works/$libro.json");
            $bookDetails = json_decode($response->getBody()->getContents(), true);

            // Configuración de valores predeterminados
            $defaultCoverUrl = asset('images/libros/default_cover.jpg');
            $authors = 'Autor no disponible';

            // Procesamiento de autores si están disponibles
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

            // Procesamiento de la descripción
            $description = 'Descripción no disponible';
            if (!empty($bookDetails['description'])) {
                $description = is_array($bookDetails['description']) ? $bookDetails['description']['value'] : $bookDetails['description'];
                $description = $this->cleanDescription($description);
            } elseif (isset($bookDetails['editions'])) {
                foreach ($bookDetails['editions'] as $edition) {
                    $editionResponse = $client->request('GET', 'https://openlibrary.org' . $edition . '.json');
                    $editionDetails = json_decode($editionResponse->getBody()->getContents(), true);
                    if (!empty($editionDetails['description'])) {
                        $description = is_array($editionDetails['description']) ? $editionDetails['description']['value'] : $editionDetails['description'];
                        break;
                    }
                }
            }

            // Configuración de la portada del libro
            $coverUrl = isset($bookDetails['covers'][0])
                ? "https://covers.openlibrary.org/b/id/{$bookDetails['covers'][0]}-L.jpg"
                : $defaultCoverUrl;

            // Búsqueda del modelo Libro en la base de datos local
            $libroModel = Libro::where('external_id', $libro)->first();

            // Cálculo de la puntuación media
            $rating = $libroModel ? number_format($libroModel->promedioPuntuacion(), 1) : 'No disponible';

            // Obtención de comentarios
            $comentarios = Comentario::where('external_id', $libro)->get();

            // Puntuación del usuario actual
            $userPuntuacion = null;

            if (Auth::check() && $libroModel) {
                DB::enableQueryLog();  // Activar el log de consultas
                $puntuacion = $libroModel->puntuacionDeUsuario(Auth::id());
                Log::info('Consulta SQL:', DB::getQueryLog());  // Registrar la consulta SQL
                $userPuntuacion = $puntuacion ? $puntuacion->puntuacion : 'No has puntuado este libro';
                Log::info('Puntuación del usuario:', ['puntuacion' => $userPuntuacion]);
            }


            // Preparación de la respuesta a la vista
            $book = [
                'title' => $bookDetails['title'] ?? 'Título no disponible',
                'authors' => $authors,
                'description' => $description,
                'cover_url' => $coverUrl,
                'rating' => $rating,
                'comentarios' => $comentarios,
                'userPuntuacion' => $userPuntuacion,
                'external_id' => $libro
            ];

            // Determinación de la vista en base al estado de autenticación del usuario
            $view = Auth::check() ? 'libros.detalle-logged' : 'libros.detalle';
            return view($view, ['book' => $book]);
        } catch (\Exception $e) {
            // Manejo de errores
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

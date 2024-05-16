<?php
namespace App\Http\Controllers;

use App\Models\EstanteriaLibro;
use App\Models\Estanteria;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Models\Comentario;
use App\Models\Puntuacion;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class EstanteriaLibroController extends Controller
{
    private function formatoEstadoLibros($status)
    {
        switch ($status) {
            case 'leyendo':
                return 'Leyendo actualmente';
            case 'leidos':
                return 'Leído';
            case 'quieroLeer':
                return 'Quiero leerlo';
            case 'abandonado':
                return 'Abandonado';
            default:
                return 'Sin Estado';
        }
    }

    public function index(Request $request)
    {
        Log::info('Entrando al método index de EstanteriaLibroController');
    
        $userId = auth()->id();
        Log::info('ID del usuario autenticado', ['userId' => $userId]);
    
        if (!$userId) {
            Log::error('Usuario no autenticado');
            return redirect()->route('login')->withErrors('Debes estar autenticado para ver tus libros.');
        }
    
        $sortBy = $request->get('sortBy', 'titulo');
        $sortOrder = $request->get('sortOrder', 'asc');
    
        $perPage = 10;
    
        $client = new Client(); // Inicializa el cliente HTTP una vez aquí
    
        $libros = EstanteriaLibro::where('user_id', $userId)
            ->get()
            ->map(function ($estanteriaLibro) use ($client) {
                Log::info('Procesando estanteriaLibro', ['estanteriaLibro' => $estanteriaLibro]);
    
                // Utilizar la caché para almacenar las respuestas de la API
                $bookDetails = Cache::remember("book_details_{$estanteriaLibro->external_id}", 3600, function () use ($estanteriaLibro, $client) {
                    try {
                        Log::info('Intentando obtener detalles del libro desde la API', ['external_id' => $estanteriaLibro->external_id]);
                        $response = $client->get("https://openlibrary.org/works/{$estanteriaLibro->external_id}.json");
                        $bookDetails = json_decode($response->getBody()->getContents(), true);
                        Log::info('Respuesta de la API obtenida', ['response' => $bookDetails]);
    
                        if (is_null($bookDetails)) {
                            throw new \Exception("No se pudieron obtener los detalles del libro desde la API.");
                        }
    
                        return $bookDetails;
                    } catch (\Exception $e) {
                        Log::error('Error obteniendo detalles del libro de la API', ['error' => $e->getMessage(), 'estanteriaLibro' => $estanteriaLibro]);
                        return null;
                    }
                });
    
                if (is_null($bookDetails)) {
                    $estanteriaLibro->titulo = 'Título no disponible';
                    $estanteriaLibro->author = 'Autor no disponible';
                    $estanteriaLibro->sinopsis = 'Descripción no disponible';
                    $estanteriaLibro->portada = asset('images/libros/default_cover.jpg');
                    $estanteriaLibro->avg_rating = 'N/A';
                    $estanteriaLibro->user_rating = 'No has puntuado este libro';
                    $estanteriaLibro->review = 'No has escrito una reseña';
                    $estanteriaLibro->date_added = 'N/A';
                } else {
                    $estanteriaLibro->titulo = $bookDetails['title'] ?? 'Título no disponible';
    
                    if (isset($bookDetails['authors']) && is_array($bookDetails['authors'])) {
                        $authorKeys = array_column($bookDetails['authors'], 'author');
                        $authorNames = [];
                        foreach ($authorKeys as $key) {
                            $authorDetails = Cache::remember("author_details_{$key['key']}", 3600, function () use ($client, $key) {
                                $authorResponse = $client->get("https://openlibrary.org{$key['key']}.json");
                                return json_decode($authorResponse->getBody()->getContents(), true);
                            });
                            $authorNames[] = $authorDetails['name'] ?? 'Nombre no disponible';
                        }
                        $estanteriaLibro->author = implode(', ', $authorNames);
                    } else {
                        $estanteriaLibro->author = 'Autor no disponible';
                    }
    
                    if (isset($bookDetails['description'])) {
                        if (is_array($bookDetails['description'])) {
                            $estanteriaLibro->sinopsis = $bookDetails['description']['value'];
                        } elseif (is_string($bookDetails['description'])) {
                            $estanteriaLibro->sinopsis = $bookDetails['description'];
                        } else {
                            $estanteriaLibro->sinopsis = 'Descripción no disponible';
                        }
                    } else {
                        $estanteriaLibro->sinopsis = 'Descripción no disponible';
                    }
    
                    if (isset($bookDetails['covers']) && is_array($bookDetails['covers']) && !empty($bookDetails['covers'])) {
                        $estanteriaLibro->portada = "https://covers.openlibrary.org/b/id/{$bookDetails['covers'][0]}-L.jpg";
                    } else {
                        $estanteriaLibro->portada = asset('images/libros/default_cover.jpg');
                    }
    
                    // Calcular la puntuación media a partir de las puntuaciones almacenadas
                    $estanteriaLibro->avg_rating = Puntuacion::promedioPuntuacion($estanteriaLibro->external_id) ?? 'N/A';
    
                    $estanteriaLibro->user_rating = Puntuacion::where('external_id', $estanteriaLibro->external_id)
                        ->where('user_id', Auth::id())
                        ->value('puntuacion') ?? 'No has puntuado este libro';
    
                    $estanteriaLibro->review = Comentario::where('external_id', $estanteriaLibro->external_id)
                        ->where('user_id', Auth::id())
                        ->value('texto') ?? 'No has escrito una reseña';
    
                    $estanteriaLibro->date_added = $estanteriaLibro->created_at->format('Y-m-d');
                }
    
                Log::info('EstanteriaLibro después de obtener datos de la API', ['estanteriaLibro' => $estanteriaLibro]);
                $estanteriaLibro->estado = $this->formatoEstadoLibros($estanteriaLibro->estado);
                return $estanteriaLibro;
            });
    
        // Agrupar todos los libros en una colección 'Todos'
        $librosAgrupados = $libros->groupBy('estado');
        $librosAgrupados['Todos'] = $libros;
    
        // Aplicar ordenamiento a cada grupo de libros
        $librosAgrupados = $librosAgrupados->map(function ($estadoLibros) use ($sortBy, $sortOrder) {
            return $estadoLibros->sortBy(function ($libro) use ($sortBy) {
                return $libro->{$sortBy};
            }, SORT_REGULAR, $sortOrder === 'desc');
        });
    
        // Convertimos las colecciones agrupadas en paginadores
        $librosAgrupados = $librosAgrupados->map(function ($estadoLibros) use ($request, $perPage) {
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $items = $estadoLibros->slice(($currentPage - 1) * $perPage, $perPage)->all();
            return new LengthAwarePaginator($items, $estadoLibros->count(), $perPage, $currentPage, [
                'path' => $request->url(),
                'query' => $request->query()
            ]);
        });
    
        Log::info('Libros agrupados por estado con paginación', ['libros' => $librosAgrupados]);
    
        return view('usuarioLogged.mis-libros', compact('librosAgrupados', 'sortBy', 'sortOrder'));
    }
    public function create()
    {
        $estanterias = Estanteria::all();
        $libros = Libro::all();
        return view('estanteriasLibros.create', compact('estanterias', 'libros'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'estanteria_id' => 'required|exists:estanterias,id',
            'external_id' => 'required',
            'estado' => 'in:leyendo,leidos,quieroLeer,abandonado,sinEstado'
        ]);

        EstanteriaLibro::create([
            'estanteria_id' => $validatedData['estanteria_id'],
            'external_id' => $validatedData['external_id'],
            'estado' => $validatedData['estado'] ?? 'sinEstado',
            'user_id' => auth()->id()
        ]);

        return redirect()->route('estanteriasLibros.index')->with('success', 'Libro añadido a la estantería exitosamente.');
    }

    public function update(Request $request, $externalId)
    {
        $validatedData = $request->validate([
            'estado' => 'required|in:leyendo,leidos,quieroLeer,abandonado,sinEstado'
        ]);

        $userId = auth()->id();
        $estanteria = Estanteria::where('user_id', $userId)->firstOrCreate([
            'user_id' => $userId,
            'nombre' => $validatedData['estado']
        ]);

        EstanteriaLibro::where('external_id', $externalId)
            ->where('user_id', $userId)
            ->delete();

        EstanteriaLibro::create([
            'external_id' => $externalId,
            'estanteria_id' => $estanteria->id,
            'estado' => $validatedData['estado'],
            'user_id' => $userId
        ]);

        return redirect()->route('libros.show', $externalId)->with('success', 'Estado del libro actualizado con éxito.');
    }

    public function destroy(EstanteriaLibro $estanteriaLibro)
    {
        $estanteriaLibro->delete();
        return redirect()->route('estanteriasLibros.index')->with('success', 'Libro eliminado de la estantería exitosamente.');
    }
}

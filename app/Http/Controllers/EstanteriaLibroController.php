<?php
namespace App\Http\Controllers;

use App\Models\EstanteriaLibro;
use App\Models\Estanteria;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class EstanteriaLibroController extends Controller
{
    
    public function index()
    {
        Log::info('Entrando al método index de EstanteriaLibroController');

        $userId = auth()->id(); // Obtiene el ID del usuario autenticado
        Log::info('ID del usuario autenticado', ['userId' => $userId]);

        if (!$userId) {
            Log::error('Usuario no autenticado');
            return redirect()->route('login')->withErrors('Debes estar autenticado para ver tus libros.');
        }

        $libros = EstanteriaLibro::where('user_id', $userId)
            ->get()
            ->map(function ($estanteriaLibro) {
                Log::info('Procesando estanteriaLibro', ['estanteriaLibro' => $estanteriaLibro]);
                
                $client = new Client();
                try {
                    Log::info('Intentando obtener detalles del libro desde la API', ['external_id' => $estanteriaLibro->external_id]);
                    $response = $client->get("https://openlibrary.org/works/{$estanteriaLibro->external_id}.json");
                    $bookDetails = json_decode($response->getBody()->getContents(), true);
                    Log::info('Respuesta de la API obtenida', ['response' => $bookDetails]);

                    if (is_null($bookDetails)) {
                        throw new \Exception("No se pudieron obtener los detalles del libro desde la API.");
                    }

                    Log::info('Detalles del libro obtenidos de la API', ['bookDetails' => $bookDetails]);

                    // Mapea los detalles del libro en el objeto $estanteriaLibro para pasarlo a la vista
                    $estanteriaLibro->titulo = $bookDetails['title'] ?? 'Título no disponible';

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
                } catch (\Exception $e) {
                    Log::error('Error obteniendo detalles del libro de la API', ['error' => $e->getMessage(), 'estanteriaLibro' => $estanteriaLibro]);
                    $estanteriaLibro->titulo = 'Título no disponible';
                    $estanteriaLibro->sinopsis = 'Descripción no disponible';
                    $estanteriaLibro->portada = asset('images/libros/default_cover.jpg');
                }

                Log::info('EstanteriaLibro después de obtener datos de la API', ['estanteriaLibro' => $estanteriaLibro]);

                return $estanteriaLibro;
            })
            ->groupBy('estado'); // Agrupa los libros por estado

        Log::info('Libros agrupados por estado', ['libros' => $libros]);

        return view('usuarioLogged.mis-libros', compact('libros'));
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

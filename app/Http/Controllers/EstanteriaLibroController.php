<?php
namespace App\Http\Controllers;

use App\Models\EstanteriaLibro;
use App\Models\Estanteria;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class EstanteriaLibroController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); // Obtiene el ID del usuario autenticado

        $libros = EstanteriaLibro::with('libro')
            ->where('user_id', $userId)
            ->get()
            ->map(function ($estanteriaLibro) {
                if (!$estanteriaLibro->libro) {
                    $client = new Client();
                    $response = $client->get("https://openlibrary.org/works/{$estanteriaLibro->external_id}.json");
                    $bookDetails = json_decode($response->getBody()->getContents(), true);

                    $libro = Libro::create([
                        'external_id' => $estanteriaLibro->external_id,
                        'titulo' => $bookDetails['title'] ?? 'Título no disponible',
                        'sinopsis' => isset($bookDetails['description']) ? (is_array($bookDetails['description']) ? $bookDetails['description']['value'] : $bookDetails['description']) : 'Descripción no disponible',
                        'portada' => isset($bookDetails['covers'][0]) ? "https://covers.openlibrary.org/b/id/{$bookDetails['covers'][0]}-L.jpg" : null,
                    ]);

                    $estanteriaLibro->libro()->associate($libro);
                }
                return $estanteriaLibro;
            })
            ->groupBy('estado'); // Agrupa los libros por estado

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

<?php
use App\Models\Noticia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticiaController extends Controller
{
    public function show($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('noticias.show', compact('noticia'));
    }
    public function index(Request $request)
{
    // Captura el criterio de ordenación de la solicitud o usa 'most-recent' por defecto
    $orden = $request->get('sort-order', 'most-recent');

    // Utiliza el método de consulta local para obtener las noticias ordenadas
    $noticias = Noticia::ordenarPorFecha($orden)->get();

    // Resto del código para pasar las noticias a la vista
    return view('noticias.index', compact('noticias'));
}
}
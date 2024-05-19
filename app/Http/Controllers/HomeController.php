<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener las últimas tres noticias
        $noticias = Noticia::orderBy('fecha', 'desc')->take(3)->get();
        
        return view('usuarioNoRegistrado.index', compact('noticias'));
    }

    public function indexLogged()
    {
        // Obtener las últimas tres noticias
        $noticias = Noticia::orderBy('fecha', 'desc')->take(3)->get();
        
        return view('usuarioLogged.index-logged', compact('noticias'));
    }

    public function adminIndex()
    {
        // Obtener las últimas tres noticias
        $noticias = Noticia::orderBy('fecha', 'desc')->take(3)->get();
        
        return view('admin.index', compact('noticias'));
    }
}

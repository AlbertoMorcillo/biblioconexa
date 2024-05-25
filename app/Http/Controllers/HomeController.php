<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Evento;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener las últimas tres noticias y eventos
        $noticias = Noticia::orderBy('fecha', 'desc')->take(3)->get();
        $eventos = Evento::orderBy('fecha', 'desc')->take(3)->get();
        
        return view('usuarioNoRegistrado.index', compact('noticias', 'eventos'));
    }

    public function indexLogged()
    {
        // Obtener las últimas tres noticias y eventos
        $noticias = Noticia::orderBy('fecha', 'desc')->take(3)->get();
        $eventos = Evento::orderBy('fecha', 'desc')->take(3)->get();
        
        return view('usuarioLogged.index-logged', compact('noticias', 'eventos'));
    }

    public function adminIndex()
    {
        // Obtener las últimas tres noticias y eventos
        $noticias = Noticia::orderBy('fecha', 'desc')->take(3)->get();
        $eventos = Evento::orderBy('fecha', 'desc')->take(3)->get();
        
        return view('admin.index', compact('noticias', 'eventos'));
    }
}

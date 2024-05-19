<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::paginate(6);
        return view('admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        $usuarioDNI = Auth::user()->dni;
        return view('admin.noticias.create', compact('usuarioDNI'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|min:5|max:255',
            'descripcion' => 'required|string|min:20',
            'fecha' => 'required|date|after_or_equal:today',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hora' => 'nullable|date_format:H:i',
        ]);
    
        $noticia = new Noticia();
        $noticia->titulo = $request->input('titulo');
        $noticia->descripcion = $request->input('descripcion');
        $noticia->fecha = $request->input('fecha');
        $noticia->user_id = Auth::id();
        $noticia->UsuarioDNI = Auth::user()->dni;
    
        if ($request->has('hora') && $request->input('fecha') > now()->toDateString()) {
            $noticia->fecha = $request->input('fecha') . ' ' . $request->input('hora') . ':00';
        } else {
            $noticia->fecha = $request->input('fecha') . ' 00:00:00';
        }
    
        if ($request->hasFile('imagen')) {
            $noticia->imagen = $request->file('imagen')->store('noticias', 'public');
        }
    
        $noticia->save();
    
        return redirect()->route('admin.noticias.index')->with('success', 'Noticia creada exitosamente.');
    }

    public function show(Noticia $noticia)
    {
        if (Auth::check() && Auth::user()->isAdmin) {
            return view('noticias.detalle-admin', compact('noticia'));
        } elseif (Auth::check()) {
            return view('noticias.detalle-logged', compact('noticia'));
        } else {
            return view('noticias.detalle', compact('noticia'));
        }
    }

    public function edit(Noticia $noticia)
    {
        return view('admin.noticias.edit', compact('noticia'));
    }
    
    public function update(Request $request, Noticia $noticia)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'imagen' => 'nullable|image|max:2048',
            'hora' => 'nullable|date_format:H:i',
        ]);
    
        $noticia->titulo = $request->input('titulo');
        $noticia->descripcion = $request->input('descripcion');
        $noticia->fecha = $request->input('fecha');
    
        if ($request->input('hora')) {
            $noticia->fecha = $request->input('fecha') . ' ' . $request->input('hora') . ':00';
        } else {
            $noticia->fecha = $request->input('fecha') . ' 00:00:00';
        }
    
        if ($request->hasFile('imagen')) {
            if ($noticia->imagen) {
                Storage::disk('public')->delete($noticia->imagen);
            }
            $noticia->imagen = $request->file('imagen')->store('noticias', 'public');
        }
    
        $noticia->save();
    
        return redirect()->route('admin.noticias.index')->with('success', 'Noticia actualizada exitosamente.');
    }
    
    public function destroy(Noticia $noticia)
    {
        if ($noticia->imagen) {
            Storage::disk('public')->delete($noticia->imagen);
        }

        $noticia->delete();

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia eliminada exitosamente.');
    }
}

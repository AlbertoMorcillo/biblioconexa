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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'hora' => 'nullable|date_format:H:i',
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');

        if ($hora && $fecha > now()->toDateString()) {
            // Fecha futura con hora específica
            $fecha = "$fecha $hora:00";
        } elseif ($fecha == now()->toDateString()) {
            // Fecha actual, usar hora actual
            $fecha = now()->format('Y-m-d H:i:s');
        } else {
            // Fecha futura sin hora específica
            $fecha = "$fecha 00:00:00";
        }

        $noticia = new Noticia();
        $noticia->titulo = $request->input('titulo');
        $noticia->descripcion = $request->input('descripcion');
        $noticia->fecha = $fecha;
        $noticia->user_id = Auth::id();
        $noticia->UsuarioDNI = Auth::user()->dni;

        if ($request->hasFile('imagen')) {
            $noticia->imagen = $request->file('imagen')->store('noticias', 'public');
        } else {
            $noticia->imagen = 'images/admin/noticias.jpg';  // Imagen predeterminada
        }

        $noticia->save();

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia creada exitosamente.');
    }

    public function show(Noticia $noticia)
    {
        $imagenPath = $noticia->imagen ? asset('storage/' . $noticia->imagen) : asset('images/admin/noticias.jpg');

        if (Auth::check() && Auth::user()->isAdmin) {
            return view('noticias.detalle-admin', compact('noticia', 'imagenPath'));
        } elseif (Auth::check()) {
            return view('noticias.detalle-logged', compact('noticia', 'imagenPath'));
        } else {
            return view('noticias.detalle', compact('noticia', 'imagenPath'));
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'hora' => 'nullable|date_format:H:i',
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');

        if ($hora && $fecha > now()->toDateString()) {
            $fecha = "$fecha $hora:00";
        } elseif ($fecha == now()->toDateString()) {
            $fecha = now()->format('Y-m-d H:i:s');
        } else {
            $fecha = "$fecha 00:00:00";
        }

        $noticia->titulo = $request->input('titulo');
        $noticia->descripcion = $request->input('descripcion');
        $noticia->fecha = $fecha;

        if ($request->hasFile('imagen')) {
            if ($noticia->imagen && $noticia->imagen !== 'images/admin/noticias.jpg') {
                Storage::disk('public')->delete($noticia->imagen);
            }
            $noticia->imagen = $request->file('imagen')->store('noticias', 'public');
        }

        $noticia->save();

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia actualizada exitosamente.');
    }

    public function destroy(Noticia $noticia)
    {
        if ($noticia->imagen && $noticia->imagen !== 'images/admin/noticias.jpg') {
            Storage::disk('public')->delete($noticia->imagen);
        }

        $noticia->delete();

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia eliminada exitosamente.');
    }
}

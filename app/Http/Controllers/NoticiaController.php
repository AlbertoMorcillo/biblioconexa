<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Imagen requerida
            'hora' => 'nullable|date_format:H:i',
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');

        if ($hora && $fecha > now()->toDateString()) {
            $fecha = "$fecha $hora:00";
        } elseif ($fecha == now()->toDateString() && !$hora) {
            $fecha = now()->format('Y-m-d H:i:s');
        } else {
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
        }

        $noticia->save();

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia creada exitosamente.');
    }

    public function show(Noticia $noticia)
    {
        $imagenPath = asset('storage/' . $noticia->imagen);

        if (Auth::check() && Auth::user()->isAdmin) {
            return view('noticias.detalle-admin', compact('noticia', 'imagenPath'));
        } elseif (Auth::check()) {
            return view('noticias.detalle-logged', compact('noticia', 'imagenPath'));
        } else {
            return view('noticias.detalle', compact('noticia', 'imagenPath'));
        }
    }

    public function noticias(Request $request)
    {
        $query = Noticia::query();

        if ($request->filled('search')) {
            $query->where('titulo', 'like', '%' . $request->search . '%')
                  ->orWhere('descripcion', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'oldest') {
                $query->orderBy('fecha', 'asc');
            } else {
                $query->orderBy('fecha', 'desc');
            }
        } else {
            $query->orderBy('fecha', 'desc');
        }

        $noticias = $query->paginate(6);

        if ($request->expectsJson()) {
            return response()->json([
                'authenticated' => Auth::check()
            ]);
        }

        if (Auth::check()) {
            return view('usuarioLogged.noticias-logged', compact('noticias'));
        }

        return view('usuarioNoRegistrado.noticias', compact('noticias'));
    }

    public function noticiasLogged(Request $request)
    {
        $query = Noticia::query();

        if ($request->filled('search')) {
            $query->where('titulo', 'like', '%' . $request->search . '%')
                  ->orWhere('descripcion', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'oldest') {
                $query->orderBy('fecha', 'asc');
            } else {
                $query->orderBy('fecha', 'desc');
            }
        } else {
            $query->orderBy('fecha', 'desc');
        }

        $noticias = $query->paginate(6);

        return view('usuarioLogged.noticias-logged', compact('noticias'));
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
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Imagen requerida
            'hora' => 'nullable|date_format:H:i',
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');

        if ($hora && $fecha > now()->toDateString()) {
            $fecha = "$fecha $hora:00";
        } elseif ($fecha == now()->toDateString() && !$hora) {
            $fecha = now()->format('Y-m-d H:i:s');
        } else {
            $fecha = "$fecha 00:00:00";
        }

        $noticia->titulo = $request->input('titulo');
        $noticia->descripcion = $request->input('descripcion');
        $noticia->fecha = $fecha;

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

<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::paginate(6);

        if (Auth::check() && Auth::user()->isAdmin) {
            return view('admin.eventos.index', compact('eventos'));
        } 
    }

    public function create()
    {
        $usuarioDNI = Auth::user()->dni;
        return view('admin.eventos.create', compact('usuarioDNI'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|min:5|max:255',
            'descripcion' => 'required|string|min:20',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'sala' => 'nullable|string|max:255',
            'UsuarioDNI' => 'required|string|max:9',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');

        $evento = new Evento();
        $evento->titulo = $request->input('titulo');
        $evento->descripcion = $request->input('descripcion');
        $evento->fecha = "$fecha $hora:00";
        $evento->hora = $hora;
        $evento->sala = $request->input('sala');
        $evento->UsuarioDNI = $request->input('UsuarioDNI');
        $evento->user_id = Auth::id();

        if ($request->hasFile('imagen')) {
            $evento->imagen = $request->file('imagen')->store('eventos', 'public');
        }

        $evento->save();

        return redirect()->route('admin.eventos.index')->with('success', 'Evento creado correctamente.');
    }

    public function show(Evento $evento)
    {
        $imagenPath = asset('storage/' . $evento->imagen);

        if (Auth::check() && Auth::user()->isAdmin) {
            return view('eventos.detalle-admin', compact('evento', 'imagenPath'));
        } elseif (Auth::check()) {
            return view('eventos.detalle-logged', compact('evento', 'imagenPath'));
        } else {
            return view('eventos.detalle', compact('evento', 'imagenPath'));
        }
    }

    public function edit(Evento $evento)
    {
        $evento->hora = \Carbon\Carbon::parse($evento->hora)->format('H:i');

        return view('admin.eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'sala' => 'nullable|string|max:255',
            'UsuarioDNI' => 'required|string|max:9',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');

        $evento->titulo = $request->input('titulo');
        $evento->descripcion = $request->input('descripcion');
        $evento->fecha = "$fecha $hora";
        $evento->hora = $hora;
        $evento->sala = $request->input('sala');
        $evento->UsuarioDNI = $request->input('UsuarioDNI');

        if ($request->hasFile('imagen')) {
            if ($evento->imagen) {
                Storage::disk('public')->delete($evento->imagen);
            }
            $evento->imagen = $request->file('imagen')->store('eventos', 'public');
        }

        $evento->save();

        return redirect()->route('admin.eventos.index')->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Evento $evento)
    {
        if ($evento->imagen) {
            Storage::disk('public')->delete($evento->imagen);
        }

        $evento->delete();

        return redirect()->route('admin.eventos.index')->with('success', 'Evento eliminado correctamente.');
    }

    public function actividadesNoRegistrado(Request $request)
    {
        $query = Evento::query();

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

        $eventos = $query->paginate(6);

        return view('usuarioNoRegistrado.actividades', compact('eventos'));
    }

    public function actividadesLogged(Request $request)
    {
        $query = Evento::query();

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

        $eventos = $query->paginate(6);

        return view('usuarioLogged.actividades-logged', compact('eventos'));
    }

    public function adminActividades(Request $request)
    {
        $query = Evento::query();

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

        $eventos = $query->paginate(6);

        return view('admin.actividades', compact('eventos'));
    }
}

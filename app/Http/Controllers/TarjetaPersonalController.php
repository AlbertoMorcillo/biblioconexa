<?php

namespace App\Http\Controllers;

use App\Models\TarjetaPersonal;
use Illuminate\Http\Request;
use App\Models\User;

class TarjetaPersonalController extends Controller
{
    public function index()
    {
        $tarjetas = TarjetaPersonal::all();

        if (auth()->check()) {
            return view('usuarioLogged.tarjetaPersonal-logged', ['tarjetas' => $tarjetas]);
        } else {
            return view('usuarioNoRegistrado.tarjetaPersonal', ['tarjetas' => $tarjetas]);
        }
    }

    public function create()
    {
        return view('tarjetaPersonal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|email|unique:tarjeta_personal,correo_electronico',
            'telefono' => 'required|string|max:15',
            'genero' => 'required|in:Hombre,Mujer,No binario,Privado',
            'fecha_nacimiento' => 'required|date',
            'dni' => 'required|string|max:9'
        ]);

        $tarjeta = new TarjetaPersonal($request->all());

        if (auth()->check()) {
            $tarjeta->user_id = auth()->id();
        } else {
            $user = User::where('dni', $request->dni)->first();
            if ($user) {
                $tarjeta->user_id = $user->id;
            }
        }

        $tarjeta->save();

        return redirect()->route('tarjetaPersonal')->with('success', 'Tarjeta personal creada con éxito.');
    }

    public function show(TarjetaPersonal $tarjetaPersonal)
    {
        return view('tarjetaPersonal.show', ['tarjeta' => $tarjetaPersonal]);
    }

    public function edit(TarjetaPersonal $tarjetaPersonal)
    {
        return view('tarjetaPersonal.edit', ['tarjeta' => $tarjetaPersonal]);
    }

    public function update(Request $request, TarjetaPersonal $tarjetaPersonal)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|email',
            'telefono' => 'required|string|max:15',
            'genero' => 'required|in:Hombre,Mujer,No binario,Privado',
            'fecha_nacimiento' => 'required|date'
        ]);

        $tarjetaPersonal->update($request->all());

        return redirect()->route('tarjetaPersonal.index')->with('success', 'Tarjeta personal actualizada con éxito.');
    }

    public function destroy(TarjetaPersonal $tarjetaPersonal)
    {
        $tarjetaPersonal->delete();
        return redirect()->route('tarjetaPersonal.index')->with('success', 'Tarjeta personal eliminada con éxito.');
    }
}

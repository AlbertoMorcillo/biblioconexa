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
            if (auth()->user()->isAdmin) { // Verifica si el usuario es administrador
                return view('admin.tarjetaPersonal', ['tarjetas' => $tarjetas]);
            }
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
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|email|unique:tarjeta_personal,correo_electronico',
            'telefono' => 'required|string|max:15',
            'genero' => 'required|in:Hombre,Mujer,No binario,Privado',
            'fecha_nacimiento' => 'required|date',
            'dni' => 'required|string|max:9|regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i'
        ]);

        // Validación del DNI
        if (!$this->validarDNI($validatedData['dni'])) {
            return redirect()->back()->withErrors(['dni' => 'DNI no válido. La letra de control no coincide.'])->withInput();
        }

        $user = User::where('dni', $validatedData['dni'])->first();

        if ($user) {
            $tarjeta = new TarjetaPersonal($validatedData);
            $tarjeta->user_id = $user->id;
        } else {
            return redirect()->back()->withErrors(['dni' => 'Usuario con el DNI proporcionado no encontrado.'])->withInput();
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
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|email',
            'telefono' => 'required|string|max:15',
            'genero' => 'required|in:Hombre,Mujer,No binario,Privado',
            'fecha_nacimiento' => 'required|date'
        ]);

        $tarjetaPersonal->update($validatedData);

        return redirect()->route('tarjetaPersonal.index')->with('success', 'Tarjeta personal actualizada con éxito.');
    }

    public function destroy(TarjetaPersonal $tarjetaPersonal)
    {
        $tarjetaPersonal->delete();
        return redirect()->route('tarjetaPersonal.index')->with('success', 'Tarjeta personal eliminada con éxito.');
    }

    private function validarDNI($dni)
    {
        $numero = substr($dni, 0, -1);
        $letra = substr($dni, -1);
        $letras = 'TRWAGMYFPDXBNJZSQVHLCKET';
        return $letras[$numero % 23] === strtoupper($letra);
    }
}

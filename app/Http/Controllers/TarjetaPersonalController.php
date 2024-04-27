<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TarjetaPersonal;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TarjetaPersonalController extends Controller
{
    public function store(Request $request)
    {
        // Validación de los datos recibidos del formulario
        $validator = Validator::make($request->all(), [
            'genero' => 'required|in:hombre,mujer,noBinario,privado',
            'fecha_nacimiento' => 'required|date',
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'required|string|max:255',
            'correo_electronico' => 'required|email|max:255|unique:tarjeta_personal,correo_electronico',
            'telefono' => 'required|string|max:255',
            'dni' => 'string|size:9|unique:tarjeta_personal,user_dni|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Verificar si el DNI pertenece a un usuario registrado
        $userDni = User::where('dni', $request->dni)->exists() ? $request->dni : null;

        // Crear la tarjeta personal con los datos validados y el DNI del usuario si está registrado
        $tarjeta = TarjetaPersonal::create(array_merge($validator->validated(), [
            'user_dni' => $userDni,
            'correo_electronico' => strtolower($request->correo_electronico),
        ]));

        // Redirigir a donde sea necesario con un mensaje de éxito
        return redirect()->route('tarjetaPersonal')->with('success', 'Tarjeta personal creada correctamente.');
    }
}

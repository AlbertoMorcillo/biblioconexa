<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        // Asegúrate de añadir la regla unique para el dni y que el email sea en minúsculas
        $validator = Validator::make($request->all(), [
            'dni' => ['required', 'regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i', 'unique:users'],
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'], // Solo letras y espacios
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Validación personalizada para el DNI
        $validator->after(function ($validator) use ($request) {
            if (!$this->validarDNI($request->dni)) {
                $validator->errors()->add('dni', 'DNI no válido. La letra de control no coincide.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'dni' => $request->dni,
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    private function validarDNI($dni)
    {
        $numero = substr($dni, 0, -1);
        $letra = substr($dni, -1);
        $letras = 'TRWAGMYFPDXBNJZSQVHLCKET';
        return $letras[$numero % 23] === strtoupper($letra);
    }
}

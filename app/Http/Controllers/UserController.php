<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Libro;
use App\Models\Estanteria;
use App\Models\EstanteriaLibro;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10); // Paginamos los usuarios para una mejor visualización
        return view('admin.usuarios.index', compact('users'));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dni' => ['required', 'max:9', 'unique:users', 'regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i'],
            'name' => ['required', 'max:255', 'regex:/^[\pL\s\-]+$/u'], // Solo letras y espacios
            'surname' => ['nullable', 'max:255', 'regex:/^[\pL\s\-]+$/u'], // Solo letras y espacios
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'numeric', 'digits_between:7,15'], // Solo números y longitud específica
            'birthdate' => ['nullable', 'date'],
            'isAdmin' => ['required', 'boolean'],
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

        User::create([
            'dni' => $request->dni,
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'isAdmin' => $request->isAdmin,
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado con éxito.');
    }

    public function show(User $user)
    {
        return view('admin.usuarios.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.usuarios.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'dni' => ['required', 'max:9', 'unique:users,dni,' . $user->id, 'regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i'],
            'name' => ['required', 'max:255', 'regex:/^[\pL\s\-]+$/u'], // Solo letras y espacios
            'surname' => ['nullable', 'max:255', 'regex:/^[\pL\s\-]+$/u'], // Solo letras y espacios
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'numeric', 'digits_between:7,15'], // Solo números y longitud específica
            'birthdate' => ['nullable', 'date'],
            'isAdmin' => ['required', 'boolean'],
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

        $data = $request->only(['dni', 'name', 'surname', 'email', 'phone', 'birthdate', 'isAdmin']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy(Request $request, User $user)
    {
        // Validar la contraseña del administrador
        $request->validate([
            'admin_password' => 'required',
        ]);

        // Verificar la contraseña del administrador
        if (!Hash::check($request->admin_password, Auth::user()->password)) {
            return redirect()->route('admin.usuarios.index')->with('error', 'Contraseña de administrador incorrecta.');
        }

        // Eliminar el usuario
        $user->delete();

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    }

    public function misLibros()
    {
        $userId = auth()->id(); // Obtén el ID del usuario autenticado

        // Obtén los libros agrupados por estado
        $libros = EstanteriaLibro::with('libro')
            ->where('user_id', $userId)
            ->get()
            ->groupBy('estado');

        // Pasa los libros a la vista
        return view('usuarioLogged.mis-libros', ['libros' => $libros]);
    }

    private function validarDNI($dni)
    {
        $numero = substr($dni, 0, -1);
        $letra = substr($dni, -1);
        $letras = 'TRWAGMYFPDXBNJZSQVHLCKET';
        return $letras[$numero % 23] === strtoupper($letra);
    }
}

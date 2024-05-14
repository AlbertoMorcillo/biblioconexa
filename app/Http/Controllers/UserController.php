<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Estanteria;
use App\Models\EstanteriaLibro;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dni' => 'required|string|max:9|unique:users,dni',
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'isAdmin' => 'sometimes|boolean'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);
        return redirect()->route('users.index')->with('success', 'Usuario creado con éxito.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'dni' => 'required|string|max:9|unique:users,dni,' . $user->id,
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:255',
            'birthdate' => 'required|date',
            'isAdmin' => 'sometimes|boolean'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito.');
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
    
}

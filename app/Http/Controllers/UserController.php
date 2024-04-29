<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function misLibros()
    {
        $user = auth()->user(); 
        $estanterias = $user->estanterias;
    
        // La variable $estanterias debe ser una colección de estanterías que pertenecen al usuario
        return view('usuarioLogged.mis-libros', compact('estanterias'));
    }
    
}

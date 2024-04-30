<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstanteriasLibros; 
use Illuminate\Support\Facades\Auth;
use App\Models\Estanterias;
use App\Models\User;


class UserController extends Controller
{
    public function misLibros()
    {
        $user = auth()->user(); // Asegura que está autenticado
        $estanterias = $user->estanterias;
        $estanterias->load('estanteriasLibros.libro'); // Carga las relaciones

        dd($estanterias);
        return view('usuarioLogged.mis-libros', compact('estanterias'));
    }
    
}

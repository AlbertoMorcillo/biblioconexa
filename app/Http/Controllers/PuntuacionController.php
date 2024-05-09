<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Puntuacion;
use Illuminate\Support\Facades\Auth;

class PuntuacionController extends Controller
{
    public function store(Request $request, $externalId)
    {
        $request->validate([
            'puntuacion' => 'required|numeric|min:1|max:5',
        ]);
    
        Puntuacion::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'external_id' => $externalId
            ],
            [
                'puntuacion' => $request->puntuacion
            ]
        );
    
        return redirect()->back()->with('success', 'Tu puntuación ha sido registrada.');
    }
    
}

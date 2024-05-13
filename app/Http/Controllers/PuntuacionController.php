<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puntuacion;
use Illuminate\Support\Facades\Auth;

class PuntuacionController extends Controller
{
    // Método existente para almacenar una puntuación
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

    // Método para actualizar la puntuación
    public function updatePuntuacion(Request $request, $externalId)
    {
        $request->validate([
            'puntuacion' => 'required|numeric|min:1|max:5',
        ]);

        // Primero, intenta eliminar cualquier puntuación existente para este libro y usuario
        Puntuacion::where('external_id', $externalId)
                  ->where('user_id', Auth::id())
                  ->delete();

        // Ahora, crea un nuevo registro con la puntuación actualizada
        Puntuacion::create([
            'user_id' => Auth::id(),
            'external_id' => $externalId,
            'puntuacion' => $request->puntuacion
        ]);

        return redirect()->back()->with('success', 'Tu puntuación ha sido actualizada.');
    }
}

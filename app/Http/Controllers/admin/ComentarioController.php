<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Comentario::with(['usuario']);

        if ($request->filled('search')) {
            $query->whereHas('usuario', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $comentarios = $query->paginate(10);

        return view('admin.comentarios.index', compact('comentarios'));
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        $comentario->delete();

        return redirect()->route('admin.comentarios.index')->with('success', 'Comentario eliminado correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TarjetaPersonal;
use App\Http\Requests\StoreTarjetaPersonalRequest;
use App\Http\Requests\UpdateTarjetaPersonalRequest;
use Illuminate\Http\Request;

class TarjetaPersonalController extends Controller
{
    public function index()
    {
        $tarjetas = TarjetaPersonal::all();
        return view('tarjetaPersonal.index', compact('tarjetas'));
    }

    public function create()
    {
        return view('tarjetaPersonal.create');
    }

    public function store(StoreTarjetaPersonalRequest $request)
    {
        TarjetaPersonal::create($request->validated());
        return redirect()->route('tarjetaPersonal.index')->with('success', 'Tarjeta personal creada con éxito.');
    }

    public function show(TarjetaPersonal $tarjetaPersonal)
    {
        return view('tarjetaPersonal.show', compact('tarjetaPersonal'));
    }

    public function edit(TarjetaPersonal $tarjetaPersonal)
    {
        return view('tarjetaPersonal.edit', compact('tarjetaPersonal'));
    }

    public function update(UpdateTarjetaPersonalRequest $request, TarjetaPersonal $tarjetaPersonal)
    {
        $tarjetaPersonal->update($request->validated());
        return redirect()->route('tarjetaPersonal.index')->with('success', 'Tarjeta personal actualizada con éxito.');
    }

    public function destroy(TarjetaPersonal $tarjetaPersonal)
    {
        $tarjetaPersonal->delete();
        return redirect()->route('tarjetaPersonal.index')->with('success', 'Tarjeta personal eliminada con éxito.');
    }
}

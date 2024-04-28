<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    public function create()
    {
        return view('formularioNuevaSede');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'dirección' => 'required',
            'capacidad' => 'required|integer',
            'accesibilidad' => 'required|boolean',
        ]);

        Sede::create($validatedData);
        return redirect('/')->with('success', 'Sede creada con éxito');
    }
}

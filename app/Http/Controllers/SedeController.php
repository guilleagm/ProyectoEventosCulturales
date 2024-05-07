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

    public function listarSedes(){
        $sedes = Sede::all();
        return view('listaSedes', compact('sedes'));
    }
    public function verSede($id)
    {
        // Fetch the specified venue by ID
        $sede = Sede::findOrFail($id);

        // Pass the venue to the view
        return view('verSede', ['sede' => $sede]);
    }
    public function editar($id)
    {
        $sede = Sede::findOrFail($id);
        return view('formularioEditarSede', ['sede' => $sede]);
    }

    // Update the specified venue
    public function actualizar(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dirección' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:0',
            'accesibilidad' => 'required|boolean'
        ]);

        // Find the venue and update its attributes
        $sede = Sede::findOrFail($id);
        $sede->update([
            'nombre' => $request->nombre,
            'dirección' => $request->dirección,
            'capacidad' => $request->capacidad,
            'accesibilidad' => $request->accesibilidad
        ]);

        return redirect()->route('sedes.ver', $sede->id)->with('success', 'Sede actualizada correctamente.');
    }
}

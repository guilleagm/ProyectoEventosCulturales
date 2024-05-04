<?php

namespace App\Http\Controllers;

use App\Models\AsignacionEntrada;
use App\Models\Evento;
use Illuminate\Http\Request;

class AsignacionEntradasController extends Controller
{
    public function mostrarCompraEntradas(Evento $evento)
    {
        return view('comprarEntradas', compact('evento'));
    }

    public function comprarEntradas(Request $request, Evento $evento)
    {
        $request->validate([
            'num_entradas_asignadas' => 'required|integer|min:1'
        ]);

        AsignacionEntrada::create([
            'id_evento' => $evento->id,
            'id_usuario' => auth()->id(),
            'num_entradas_asignadas' => $request->num_entradas_asignadas
        ]);

        return redirect()->route('eventos.ver', $evento->id)->with('success', 'Entradas compradas con éxito.');
    }

}

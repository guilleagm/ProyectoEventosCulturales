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

        // Verificar que hay suficientes entradas disponibles
        if ($evento->num_entradas_disponibles < $request->num_entradas_asignadas) {
            return back()->with('error', 'No hay suficientes entradas disponibles.');
        }

        AsignacionEntrada::create([
            'id_evento' => $evento->id,
            'id_usuario' => auth()->id(),
            'num_entradas_asignadas' => $request->num_entradas_asignadas
        ]);

        $evento->num_entradas_disponibles -= $request->num_entradas_asignadas;
        $evento->save();

        return redirect()->route('eventos.ver', $evento->id)->with('success', 'Entradas compradas con éxito.');
    }

    public function cancelarCompra($id)
    {
        $asignacion = AsignacionEntrada::findOrFail($id);

        // Verificar que el usuario autenticado es el mismo que compró la entrada o es un administrador
        if (auth()->id() != $asignacion->id_usuario && !auth()->user()->esAdmin) {
            return back()->with('error', 'No autorizado');
        }

        $evento = Evento::findOrFail($asignacion->id_evento);
        $evento->num_entradas_disponibles += $asignacion->num_entradas_asignadas;
        $evento->save();
        $asignacion->delete();

        return redirect()->route('eventos.ver', $evento->id)->with('success', 'Entrada cancelada con éxito.');
    }

}

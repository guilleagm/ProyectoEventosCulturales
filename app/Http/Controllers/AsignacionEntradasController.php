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

    public function mostrarConfirmacionCancelacion($idEvento)
    {
        $evento = Evento::findOrFail($idEvento);

        return view('cancelarCompra', compact('evento'));
    }
    public function cancelarCompra($idEvento)
    {
        $evento = Evento::findOrFail($idEvento);
        $idUsuario = auth()->id();  // ID del usuario autenticado

        $asignacion = AsignacionEntrada::where('id_evento', $idEvento)
            ->where('id_usuario', $idUsuario)
            ->first();

        if (!$asignacion && !auth()->user()->isAdmin) {
            return back()->with('error', 'No autorizado');
        }

        if ($asignacion) {
            $evento->num_entradas_disponibles += $asignacion->num_entradas_asignadas;
            $evento->save();

            // Eliminar la asignación manualmente si no hay un 'id'
            AsignacionEntrada::where('id_evento', $idEvento)
                ->where('id_usuario', $idUsuario)
                ->delete();  // Usar delete() directamente en la consulta
        }

        return redirect()->route('eventos.ver', $evento->id)->with('success', 'Entrada cancelada con éxito.');
    }

}

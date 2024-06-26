<?php

namespace App\Http\Controllers;

use App\Mail\ComprarEntradas;
use App\Mail\DevolverEntradas;
use App\Models\AsignacionEntrada;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AsignacionEntradasController extends Controller
{
    public function mostrarCompraEntradas(Evento $evento)
    {
        return view('comprarEntradas', compact('evento'));
    }

    public function comprarEntradas(Request $request, Evento $evento)
    {
        $request->validate([
            'num_entradas_asignadas' => 'required|integer|min:1|max:5'
        ]);

        if ($evento->num_entradas_disponibles < $request->num_entradas_asignadas) {
            return back()->with('error', 'No hay suficientes entradas disponibles.');
        }

        $asignacion = AsignacionEntrada::create([
            'id_evento' => $evento->id,
            'id_usuario' => auth()->id(),
            'num_entradas_asignadas' => $request->num_entradas_asignadas
        ]);

        $evento->num_entradas_disponibles -= $request->num_entradas_asignadas;
        $evento->save();

        // Generar PDF y enviar por correo
        $pdf = $this->generarPDF($evento, $request->num_entradas_asignadas);
        $pdfPath = storage_path('app/public/entradas/' . $pdf);
        Mail::to(auth()->user()->correo)->send(new ComprarEntradas($evento, $request->num_entradas_asignadas, $pdfPath));

        return redirect()->route('eventos.ver', $evento->id)->with('success', 'Entradas compradas con éxito.');
    }

    private function generarPDF($evento, $numEntradas)
    {
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('entrada', compact('evento', 'numEntradas'));
        $filename = 'Entrada-' . $evento->id . '-' . time() . '.pdf';

        // Asegurarse de que la carpeta exista
        $path = storage_path('app/public/entradas/');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $pdf->save($path . $filename);
        return $filename;
    }

    public function mostrarConfirmacionCancelacion($idEvento)
    {
        $evento = Evento::findOrFail($idEvento);

        return view('cancelarCompra', compact('evento'));
    }
    public function cancelarCompra($idEvento)
    {
        $evento = Evento::findOrFail($idEvento);
        $usuario = auth()->user();
        $idUsuario = $usuario->id;

        $asignacion = AsignacionEntrada::where('id_evento', $idEvento)
            ->where('id_usuario', $idUsuario)
            ->first();

        if (!$asignacion && !auth()->user()->isAdmin) {
            return back()->with('error', 'No autorizado');
        }

        if ($asignacion) {
            $evento->num_entradas_disponibles += $asignacion->num_entradas_asignadas;
            $evento->save();

            AsignacionEntrada::where('id_evento', $idEvento)
                ->where('id_usuario', $idUsuario)
                ->delete();

            Mail::to($usuario->correo)->send(new DevolverEntradas($evento, $asignacion->num_entradas_asignadas));

            return redirect()->route('eventos.ver', $evento->id)->with('success', 'Entrada devuelta con éxito.');
        }

        return back()->with('error', 'No se pudo procesar la devolución.');
    }

}

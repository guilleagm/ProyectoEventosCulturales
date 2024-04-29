<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class EventoController extends Controller
{
    public function showEventForm()
    {
        return view('formularioNuevoEvento');
    }

    // Método para almacenar un nuevo evento en la base de datos
    public function storeEvent(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
        ]);

        // Crear un nuevo evento con los datos proporcionados
        Event::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
        ]);

        // Redirigir a alguna página de confirmación o a donde desees
        return redirect()->route('home')->with('success', 'Evento programado exitosamente');
    }
}

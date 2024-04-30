<?php

namespace App\Http\Controllers;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class EventoController extends Controller
{
    public function mostrarFormularioEvento()
    {
        return view('formularioNuevoEvento');
    }

    // Método para almacenar un nuevo evento en la base de datos
    public function nuevoEvento(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'categoria' => 'required|string|max:255',
            'num_entradas_disponibles' => 'required|integer|min:1',
            'estado' => 'required|string|max:255',
            'id_sede' => 'required|integer'
        ]);

        // Crear un nuevo evento con los datos proporcionados
        Evento::create([
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'categoria' => $request->categoria,
            'num_entradas_disponibles' => $request->num_entradas_disponibles,
            'estado' => $request->estado,
            'id_sede' => $request->id_sede
        ]);

        // Redirigir a alguna página de confirmación o a donde desees
        return redirect()->route('home')->with('success', 'Evento programado exitosamente');
    }

    public function listarEventos()
    {
        $eventos = Evento::all();
        return view('listaEventos', ['eventos' => $eventos]);
    }
}

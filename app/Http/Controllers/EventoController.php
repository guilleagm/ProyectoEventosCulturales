<?php

namespace App\Http\Controllers;
use App\Mail\CancelarEvento;
use App\Models\Artista;
use App\Models\Comentario;
use App\Models\Evento;
use App\Models\Noticia;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class EventoController extends Controller
{
    public function mostrarFormularioEvento()
    {
        $sedes = Sede::all();
        return view('formularioNuevoEvento', compact('sedes'));
    }

    // Método para almacenar un nuevo evento en la base de datos
    public function nuevoEvento(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required|string',
            'categoria' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'id_sede' => 'required|integer',
            'imagen' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $sede = Sede::find($request->id_sede);
        if (!$sede) {
            return back()->with('error', 'Sede no encontrada. Asegúrese de que el ID de la sede es correcto.');
        }

        if ($request->hasFile('imagen')) {
            $imageFile = $request->file('imagen');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('images'), $imageName);

            Evento::create([
                'titulo' => $request->titulo,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'categoria' => $request->categoria,
                'num_entradas_disponibles' => $sede->capacidad,
                'estado' => $request->estado,
                'id_sede' => $request->id_sede,
                'imagen' => $imageName,
                'id_usuario' => auth()->id()
            ]);

            return redirect('/')->with('success', 'Evento programado exitosamente');
        } else {
            return back()->with('error', 'Error al subir la imagen. Asegúrese de que ha seleccionado un archivo válido.');
        }
    }

    public function listarEventos()
    {
        $eventos = Evento::with('sede')->simplePaginate(8);
        return view('listaEventos', ['eventos' => $eventos]);
    }

    public function verEvento($id) {
        $evento = Evento::with('asignacionEntradas')->findOrFail($id);
        $comentarios = Comentario::where('id_evento', $id)->with('usuario')->get();
        $usuarioHaComprado = $evento->asignacionEntradas()->where('id_usuario', auth()->id())->exists();
        return view('verEvento', compact('evento', 'comentarios', 'usuarioHaComprado'));
    }

    public function editar($id)
    {
        $evento = Evento::findOrFail($id);
        return view('formularioEditarEvento', compact('evento'));
    }

    public function actualizar(Request $request, $id)
    {
        // Validate other event attributes
        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'categoria' => 'required|string|max:255',
            'num_entradas_disponibles' => 'required|integer|min:1',
            'estado' => 'required|string|max:255',
            'id_sede' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // Optional image validation
        ]);

        // Find the event record
        $evento = Evento::findOrFail($id);

        // Check for a new image file
        if ($request->hasFile('imagen')) {
            // Delete the old image if it exists
            if ($evento->imagen && file_exists(public_path('images/' . $evento->imagen))) {
                unlink(public_path('images/' . $evento->imagen));
            }

            // Store the new image
            $imageFile = $request->file('imagen');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('images'), $imageName);

            // Update the event's image field
            $evento->imagen = $imageName;
        }

        // Update other attributes
        $evento->update([
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'categoria' => $request->categoria,
            'num_entradas_disponibles' => $request->num_entradas_disponibles,
            'estado' => $request->estado,
            'id_sede' => $request->id_sede
        ]);

        // Save the image field separately (if modified)
        $evento->save();

        return redirect()->route('eventos.listar')->with('success', 'Evento actualizado exitosamente');
    }

    public function guardarComentario(Request $request, $eventoId)
    {
        $request->validate([
            'contenido' => 'required|string',
            'valoracion' => 'required|integer|min:1|max:5',
        ]);

        Comentario::create([
            'contenido' => $request->contenido,
            'valoracion' => $request->valoracion,
            'fecha' => now(),
            'id_evento' => $eventoId,
            'id_usuario' => auth()->id(),
        ]);

        return back()->with('success', 'Comentario añadido con éxito');
    }
    public function buscar(Request $request)
    {
        $userName = $request->input('artist-name');

        $eventos = Evento::whereHas('usuario', function ($query) use ($userName) {
            $query->where('nombre_usuario', 'like', '%' . $userName . '%');
        })->get();

        // Return the search results to a view
        return view('resultadosBusqueda', ['eventos' => $eventos, 'busqueda' => $userName]);
    }
    public function filtrar(Request $request)
    {
        $categoria = $request->input('categoria');

        $query = Evento::query();

        if (!empty($categoria)) {
            $query->where('categoria', $categoria);
        }

        $eventos = $query->get();

        return view('listaEventos', ['eventos' => $eventos]);
    }
    public function showIndex()
    {
        $eventos = Evento::all();
        $noticias = Noticia::all();
        return view('index', ['eventos' => $eventos, 'noticias' => $noticias]);
    }

    public function cancelEvent(Evento $evento)
    {
        if (!auth()->check() || (auth()->user()->id !== $evento->id_usuario && !auth()->user()->esAdmin)) {
            abort(403, 'No autorizado para cancelar este evento.');
        }

        $evento->update(['estado' => 'Cancelado']);

        $attendees = $evento->attendees;

        if ($attendees->count() > 0) {
            foreach ($attendees as $user) {
                if (filter_var($user->correo, FILTER_VALIDATE_EMAIL)) {
                    Mail::to($user->correo)->send(new CancelarEvento($evento));
                }
            }
        }

        return back()->with('success', 'Evento cancelado y correos enviados.');
    }

}

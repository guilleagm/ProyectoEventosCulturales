<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function create()
    {
        return view('formularioNuevaNoticia');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario incluyendo la imagen
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación para la imagen
            'id_artista' => 'required|exists:artistas,id',
            'id_usuario' => 'required|exists:users,id',
        ]);

        // Comprobar si el archivo de imagen está presente en la solicitud
        if ($request->hasFile('imagen')) {
            $imageFile = $request->file('imagen');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension(); // Generar un nombre único para la imagen
            $imagePath = $imageFile->move(public_path('images'), $imageName); // Mover la imagen al directorio público

            // Crear el registro de la noticia con la imagen adecuadamente guardada
            Noticia::create([
                'titulo' => $validatedData['titulo'],
                'texto' => $validatedData['texto'],
                'imagen' => $imageName, // Guardar solo el nombre de la imagen
                'id_artista' => $validatedData['id_artista'],
                'id_usuario' => $validatedData['id_usuario'],
            ]);

            return redirect('/')->with('success', 'Noticia creada con éxito');
        } else {
            return back()->with('error', 'Error al subir la imagen. Asegúrese de que ha seleccionado un archivo válido.');
        }
    }


    public function listarNoticias()
    {
        $noticias = Noticia::simplePaginate(6);
        return view('listaNoticias', compact('noticias'));
    }

    public function verNoticia($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('verNoticia', compact('noticia'));
    }

    public function edit(Noticia $noticia)
    {
        return view('formularioEditarNoticia', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación opcional de imagen
            'id_artista' => 'required|exists:artistas,id',
            'id_usuario' => 'required|exists:users,id',
        ]);

        // Comprobar si hay un nuevo archivo de imagen en la solicitud
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen antigua si existe
            if ($noticia->imagen && file_exists(public_path('images/' . $noticia->imagen))) {
                unlink(public_path('images/' . $noticia->imagen));
            }

            // Almacenar la nueva imagen
            $imageFile = $request->file('imagen');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension(); // Nombre de archivo único
            $imageFile->move(public_path('images'), $imageName); // Mover la imagen al directorio público

            // Actualizar el campo imagen de la noticia
            $validatedData['imagen'] = $imageName;
        }

        // Actualizar otros atributos de la noticia
        $noticia->update($validatedData);

        return redirect()->route('noticias.show', $noticia->id)->with('success', 'Noticia actualizada correctamente.');
    }

    // Función para eliminar una noticia
    public function destroy(Noticia $noticia)
    {
        $noticia->delete();

        return redirect()->route('noticias.index')->with('success', 'Noticia eliminada correctamente.');
    }

    public function index() {
        // Carga las noticias incluyendo los datos del artista y del usuario
        $noticias = Noticia::with('artista.usuario')->get();
        return view('noticias.index', compact('noticias'));
    }
}

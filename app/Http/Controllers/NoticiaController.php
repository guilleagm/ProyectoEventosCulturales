<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function create()
    {
        return view('formularioNuevaNoticia');
    }

    public function nuevaNoticia(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_artista' => 'required|exists:artistas,id',
        ]);

        if ($request->hasFile('imagen')) {
            $imageFile = $request->file('imagen');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imagePath = $imageFile->move(public_path('images'), $imageName);

            Noticia::create([
                'titulo' => $validatedData['titulo'],
                'texto' => $validatedData['texto'],
                'imagen' => $imageName,
                'id_artista' => $validatedData['id_artista'],
                'id_usuario' => auth()->id(),
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

    public function editarNoticia(Request $request, Noticia $noticia)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_artista' => 'required|exists:artistas,id',
        ]);

        if ($request->hasFile('imagen')) {
            if ($noticia->imagen && file_exists(public_path('images/' . $noticia->imagen))) {
                unlink(public_path('images/' . $noticia->imagen));
            }

            $imageFile = $request->file('imagen');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('images'), $imageName);
            $noticia->imagen = $imageName;
        }

        $noticia->update([
            'titulo' => $request->titulo,
            'texto' => $request->texto,
            'id_artista' => $request->id_artista,
            'imagen' => $noticia->imagen
        ]);

        return redirect()->route('noticias.show', $noticia->id)->with('success', 'Noticia actualizada correctamente.');
    }

    public function eliminarNoticia(Noticia $noticia)
    {
        $noticia->delete();

        return redirect()->route('noticias.index')->with('success', 'Noticia eliminada correctamente.');
    }

    public function index() {
        $noticias = Noticia::with('artista.usuario')->get();
        return view('noticias.index', compact('noticias'));
    }
}

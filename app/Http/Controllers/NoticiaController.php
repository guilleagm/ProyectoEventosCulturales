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
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'required',
            'id_artista' => 'required|exists:artistas,id',
            'id_usuario' => 'required|exists:users,id',
        ]);

        Noticia::create($validatedData);
        return redirect('/')->with('success', 'Noticia creada con éxito');
    }

    public function listarNoticias()
    {
        $noticias = Noticia::all();
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
            'id_artista' => 'required|exists:artistas,id',
            'id_usuario' => 'required|exists:users,id',
        ]);

        $noticia->update($validatedData);

        return redirect()->route('noticias.show', $noticia->id)->with('success', 'Noticia actualizada correctamente.');
    }

    // Función para eliminar una noticia
    public function destroy(Noticia $noticia)
    {
        $noticia->delete();

        return redirect()->route('noticias.index')->with('success', 'Noticia eliminada correctamente.');
    }
}

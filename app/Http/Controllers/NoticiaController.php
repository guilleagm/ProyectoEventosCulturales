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
            'texto' => 'required',
            'id_artista' => 'required|exists:artistas,id',
            'id_usuario' => 'required|exists:users,id',
        ]);

        Noticia::create($validatedData);
        return redirect('/')->with('success', 'Noticia creada con éxito');
    }
}

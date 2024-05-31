<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ArtistaController extends Controller
{
    public function showRegistrationForm()
    {
        return view('formularioNuevoArtista');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'biografia' => 'required|string',
            'genero' => 'required|string|max:255',
        ]);

        Artista::create([
            'nombre' => $request->nombre,
            'biografia' => $request->biografia,
            'genero' => $request->genero,
            'id_usuario' => Auth::id(),
        ]);

        return redirect()->route('home');
    }
}

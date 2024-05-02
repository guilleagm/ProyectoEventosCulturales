<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\User;
use App\Models\UserArtistaFav;
use Illuminate\Http\Request;

class UserArtistaFavController extends Controller
{
    public function agregarFavorito(User $usuario, Artista $artista)
    {
        // Verificar si ya está en favoritos
        if ($usuario->artistasFavoritos()->where('id_artista', $artista->id)->exists()) {
            return redirect()->back()->with('error', '¡El artista ya está en tus favoritos!');
        }
        // Agregar a favoritos
        UserArtistaFav::create([
            'id_usuario' => $usuario->id,
            'id_artista' => $artista->id,
        ]);

        return redirect()->back()->with('success', '¡Artista añadido a favoritos!');
    }

    public function eliminarFavorito(User $usuario, Artista $artista)
    {
        $entry = $usuario->artistasFavoritos()->where('id_artista', $artista->id)->first();

        if ($entry) {
            $usuario->artistasFavoritos()->detach($artista->id);
            return redirect()->back()->with('success', 'Artista eliminado de favoritos.');
        } else {
            return redirect()->back()->with('error', 'Artista no encontrado en tus favoritos.');
        }
    }

}

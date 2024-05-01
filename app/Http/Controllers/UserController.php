<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function listar()
    {
        if (auth()->user()->esAdmin) {
            $users = User::all();
            $artistas = Artista::all();
            return view('listaUsuarios', compact('users','artistas'));
        }

        return redirect('/');
    }

    public function show(User $user)
    {
        return view('perfilUsuario', compact('user'));
    }

    public function eliminarUsuario(User $user)
    {
        if (auth()->user()->esAdmin) {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
        }
        abort(403, 'No autorizado.');
    }

    public function verPerfil($id){
        $user = User::findOrFail($id);
        $artista = Artista::where('id_usuario', $id)->first();
        return view('perfilUsuario', compact('user', 'artista'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $esArtista = Artista::where('id_usuario', $id)->exists();
        $artista = Artista::where('id_usuario', $id)->first();

        return view('formularioEditarPerfil', [
            'user' => $user,
            'esArtista' => $esArtista,
            'artista' => $artista
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:users,correo,' . $id,
            'nombre' => 'sometimes|required|string|max:255',
            'biografia' => 'nullable|string',
            'genero' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
        ]);

        if ($request->has('nombre_artista')) {
            $artista = Artista::updateOrCreate(
                ['id_usuario' => $id],
                [
                    'nombre' => $request->nombre,
                    'biografia' => $request->biografia,
                    'genero' => $request->genero,
                ]
            );
        }

        return redirect()->route('users.profile', $id)->with('success', 'Perfil actualizado correctamente.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() === $user->id) {
            // Eliminar al usuario
            $user->delete();

            // Cerrar la sesión
            Auth::logout();

            return redirect()->route('home')->with('success', 'Tu cuenta ha sido eliminada correctamente.');
        } else {
            // Si el usuario autenticado no es el mismo que se está intentando eliminar, mostrar un mensaje de error
            abort(403, 'No tienes permiso para eliminar este usuario.');
        }
    }
}

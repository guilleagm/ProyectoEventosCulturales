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
        $artista = Artista::where('id_usuario', $user->id)->first();
        return view('perfilUsuario', compact('user','artista'));
    }

    public function eliminarUsuario(User $user)
    {
        if (auth()->user()->esAdmin) {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
        }
        abort(403, 'No autorizado.');
    }

    public function verPerfil($id)
    {
        $user = User::findOrFail($id);
        $artista = Artista::where('id_usuario', $id)->first();

        // Comprueba si el usuario consultado es un artista
        $esArtistaPerfil = !is_null($artista);

        // Comprueba si el usuario logueado es un artista, mantiene el nombre de la variable como $esArtista
        $esArtista = Auth::check() && Artista::where('id_usuario', Auth::id())->exists();

        // Retorna la vista con todas las variables necesarias
        return view('perfilUsuario', [
            'user' => $user,
            'artista' => $artista,
            'esArtistaPerfil' => $esArtistaPerfil,
            'esArtista' => $esArtista
        ]);
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
        // Validate the basic user attributes and image
        $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:users,correo,' . $id,
            'nombre' => 'sometimes|required|string|max:255',
            'biografia' => 'nullable|string',
            'genero' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // Validate the image
        ]);

        // Retrieve the user instance
        $user = User::findOrFail($id);

        // Check if there's a new image to be uploaded
        if ($request->hasFile('imagen')) {
            // Delete the existing image if available
            if ($user->imagen && file_exists(public_path('images/users/' . $user->imagen))) {
                unlink(public_path('images/users/' . $user->imagen));
            }

            // Save the new image file
            $imageFile = $request->file('imagen');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('images/users'), $imageName);

            // Update the user's image field
            $user->imagen = $imageName;
        }

        // Update the user information
        $user->update([
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
        ]);

        // Check if the user is also an artist
        if ($request->has('nombre')) {
            $artista = Artista::updateOrCreate(
                ['id_usuario' => $id],
                [
                    'nombre' => $request->nombre,
                    'biografia' => $request->biografia,
                    'genero' => $request->genero
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

            return redirect()->route('/')->with('success', 'Tu cuenta ha sido eliminada correctamente.');
        } else {
            // Si el usuario autenticado no es el mismo que se está intentando eliminar, mostrar un mensaje de error
            abort(403, 'No tienes permiso para eliminar este usuario.');
        }
    }

    /*public function comprobarArtista($id){
        // Verifica si el usuario autenticado es artista
        $esArtista = false;
        if (Auth::check()) {
            $esArtista = Artista::where('id_usuario', Auth::id())->exists();
        }
        return view('perfilUsuario',['esArtista' => $esArtista]);
    }*/
}

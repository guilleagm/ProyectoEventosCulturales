<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\AsignacionEntrada;
use App\Models\Evento;
use App\Models\Noticia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function listar()
    {
        if (auth()->user()->esAdmin) {
            $users = User::simplePaginate(11);
            $admins = User::all();
            $artistas = Artista::simplePaginate(8);
            return view('listaUsuarios', compact('users','admins','artistas'));
        }

        return redirect('/');
    }

    public function verPerfil($id)
    {
        $user = User::findOrFail($id);
        $artista = Artista::where('id_usuario', $id)->first();

        $esArtistaPerfil = !is_null($artista);

        $esArtistaLogueado = Auth::check() && Artista::where('id_usuario', Auth::id())->exists();

        $puedeRegistrarArtista = Auth::check() && !$esArtistaLogueado && $id == Auth::id();

        return view('perfilUsuario', [
            'user' => $user,
            'artista' => $artista,
            'esArtistaPerfil' => $esArtistaPerfil,
            'esArtistaLogueado' => $esArtistaLogueado,
            'puedeRegistrarArtista' => $puedeRegistrarArtista
        ]);
    }

    public function eliminarUsuario(User $user)
    {
        if (auth()->user()->esAdmin) {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
        }
        abort(403, 'No autorizado.');
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

    public function editarPerfil(Request $request, $id)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:users,correo,' . $id,
            'nombre' => 'sometimes|required|string|max:255',
            'biografia' => 'nullable|string',
            'genero' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('imagen')) {
            if ($user->imagen && file_exists(public_path('images/users/' . $user->imagen))) {
                unlink(public_path('images/users/' . $user->imagen));
            }

            $imageFile = $request->file('imagen');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('images/users'), $imageName);

            $user->imagen = $imageName;
        }

        $user->update([
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
        ]);

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
            Artista::where('id_usuario', $id)->delete();
            Evento::where('id_usuario', $id)->delete();
            Noticia::where('id_usuario', $id)->delete();
            AsignacionEntrada::where('id_usuario', $id)->delete();
            $user->delete();

            Auth::logout();

            return redirect()->route('login')->with('success', 'Tu cuenta ha sido eliminada correctamente.');
        } else {
            abort(403, 'No tienes permiso para eliminar este usuario.');
        }
    }

    public function cambiarContraseña(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->getAuthPassword())) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        $user->update([
            'contraseña' => Hash::make($request->new_password),
        ]);

        Auth::logout();

        return redirect()->route('login')->with('success', 'Contraseña actualizada correctamente.');
    }

    public function mostrarFormCambioContraseña()
    {
        return view('formularioCambiarContraseña');
    }
}

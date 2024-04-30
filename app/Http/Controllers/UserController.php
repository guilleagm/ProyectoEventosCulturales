<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function listar()
    {
        if (auth()->user()->esAdmin) {
            $users = User::all();
            return view('listaUsuarios', compact('users'));
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
        return view('perfilUsuario', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('formularioEditarPerfil', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:users,correo,'.$id,
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
        ]);

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

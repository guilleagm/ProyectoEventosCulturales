<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerForm(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validate inputs including image
        $request->validate([
            'nombre_usuario' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:users,correo'],
            'contraseña' => ['required', 'min:6'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        $imageName = null;
        if ($request->hasFile('imagen')) {
            $imageFile = $request->file('imagen');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('images/users'), $imageName);
        }

        $user = User::create([
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
            'contraseña' => Hash::make($request->contraseña),
            'imagen' => $imageName
        ]);

        Auth::login($user);

        return redirect('/');
    }

}

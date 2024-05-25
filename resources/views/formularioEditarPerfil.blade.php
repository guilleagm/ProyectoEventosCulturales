<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CulturaVibe</title>
    <link rel="stylesheet" href="{{ asset('css/estilos1.css') }}">
    <script src="/js/menuFotoPerfil.js"></script>
</head>
<body>
<div class="container">
    @include('menu')
    <h2>Editar Perfil</h2>
    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grupo-form">
            <label for="nombre_usuario">Nombre de Usuario:</label><br>
            <input type="text" name="nombre_usuario" class="input-form" value="{{ $user->nombre_usuario }}" required>
        </div>
        <div class="grupo-form">
            <label for="correo">Correo:</label><br>
            <input type="email" name="correo" class="input-form" value="{{ $user->correo }}" required>
        </div>
        <div class="grupo-form">
            <label for="imagen">Imagen de Perfil (Opcional):</label><br>
            <input type="file" name="imagen" accept="image/*" class="input-form">
        </div>
        @if ($esArtista)
            <div class="grupo-form">
                <label for="nombre">Nombre Artístico:</label><br>
                <input id="nombre" name="nombre" class="input-form" value="{{ $artista->nombre }}">
            </div>
            <div class="grupo-form">
                <label for="biografia">Biografía:</label><br>
                <textarea id="biografia" name="biografia" class="input-form">{{ $artista->biografia }}</textarea>
            </div>
            <div class="grupo-form">
                <label for="genero">Género:</label><br>
                <input id="genero" name="genero" class="input-form" value="{{ $artista->genero }}">
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
    </form>
    <form>
        <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
    </form>
</div>
@include('pie')

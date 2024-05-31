<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CulturaVibe</title>
    <link rel="stylesheet" href="{{ asset('css/estilos1.css') }}">
    <script src="/js/menuFotoPerfil.js"></script>
    <script src="/js/hamburguesa.js"></script>
</head>
<body>
<div class="container">
    @include('menu')
    <h1>Perfil de Usuario</h1>
    <div class="profile">
        @if ($user->imagen)
            <img src="{{ asset('images/users/' . $user->imagen) }}" alt="Imagen de {{ $user->nombre_usuario }}" class="profile-image">
        @else
            <p><strong>Imagen:</strong> No hay imagen de perfil disponible</p>
        @endif
        <p><strong>Nombre de Usuario: </strong>{{ $user->nombre_usuario }}</p>
        <p><strong>Correo: </strong> {{ $user->correo }}</p>

        @if ($artista)
            <div class="artist-details">
                <h2>Datos del Artista</h2>
                <p><strong>Nombre Artístico: </strong>{{ $artista->nombre }}</p>
                <p id="bio"><strong>Biografía: </strong><br> {{ $artista->biografia }}</p>
                <p><strong>Género: </strong> {{ $artista->genero }}</p>
            </div>
        @endif

        @if ($puedeRegistrarArtista)
            <a href="{{ route('registro.artista') }}" class="btn btn-primary">Registrarse como artista</a><br>
        @endif
        @if($esArtistaLogueado)
            <a href="{{ route('programarEvento') }}" class="btn btn-primary">Programar Evento</a><br>
        @endif
        @auth
            @if (auth()->user()->id == $user->id)
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar Perfil</a>
            @endif
        @endauth
        @if (auth()->check() && auth()->user()->esAdmin && auth()->user()->id != $user->id)
            <form action="{{ route('users.eliminarUsuario', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
            </form>
        @endif

        @if (auth()->check() && auth()->user()->id == $user->id)
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
            </form>
        @endif
    </div>
</div>
@include('pie')
</body>

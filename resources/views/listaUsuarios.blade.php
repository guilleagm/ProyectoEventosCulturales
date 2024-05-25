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
@auth
    @if (Auth::user()->esAdmin)
        <h1>Lista de Usuarios</h1>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ route('users.profile', $user->id) }}">
                            {{ $user->nombre_usuario }}
                        </a></td>
                    <td>{{ $user->correo }}</td>
                    <td>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <h1>Lista de Artistas</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Nombre Artístico</th>
                <th>Biografia</th>
                <th>Género</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($artistas as $artista)
                <tr>
                    <td><a href="{{ route('users.profile', $artista->id_usuario) }}">{{ $artista->nombre }}</a></td>
                    <td>{{ $artista->biografia }}</td>
                    <td>{{ $artista->genero }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endauth
</div>
@include('pie')

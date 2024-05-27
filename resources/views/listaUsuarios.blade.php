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
            <div class="table-container">
                <!-- Lista de Usuarios no administradores -->
                <div>
                    <h1>Lista de Usuarios</h1>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            @if($user->esAdmin == 0)
                            <tr>
                                <td><a href="{{ route('users.profile', $user->id) }}">{{ $user->nombre_usuario }}</a></td>
                                <td>{{ $user->correo }}</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div id="paginador">
                        {{ $users->links() }}
                    </div>
                </div>
                <!-- Lista de Administradores -->
                <div>
                    <h1>Lista de Administradores</h1>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            @if($admin->esAdmin == 1)
                            <tr>
                                <td><a href="{{ route('users.profile', $admin->id) }}">{{ $admin->nombre_usuario }}</a></td>
                                <td>{{ $admin->correo }}</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Lista de Artistas -->
                <div>
                    <h1>Lista de Artistas</h1>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre Artístico</th>
                            <th>Género</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($artistas as $artista)
                            <tr>
                                <td><a href="{{ route('users.profile', $artista->id_usuario) }}">{{ $artista->nombre }}</a></td>
                                <td>{{ $artista->genero }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div id="paginador">
                        {{ $artistas->links() }}
                    </div>
                </div>
            </div>
        @endif
    @endauth
</div>
@include('pie')

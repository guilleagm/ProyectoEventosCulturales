<link rel="stylesheet" href="/css/estilos1.css">
@auth
    @if (Auth::user()->esAdmin)
    <div class="container">
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
                    <td><a href="{{ route('users.show', $user->id) }}">
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
                    <td><a href="{{ route('users.show', $artista->id_usuario) }}">{{ $artista->nombre }}</a></td>
                    <td>{{ $artista->biografia }}</td>
                    <td>{{ $artista->genero }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
@endauth

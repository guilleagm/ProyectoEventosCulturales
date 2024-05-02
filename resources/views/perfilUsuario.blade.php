<div class="container">
    <h1>Perfil de Usuario</h1>
    <div class="profile">
        <p><strong>Nombre de Usuario:</strong> {{ $user->nombre_usuario }}</p>
        <p><strong>Correo:</strong> {{ $user->correo }}</p>

        @if ($artista)
            <h2>Datos del Artista</h2>
            <p><strong>Nombre Artístico:</strong> <a href="{{ route('users.show', $artista->id) }}">{{ $artista->nombre }}</a></p>
            <p><strong>Biografía:</strong> {{ $artista->biografia }}</p>
            <p><strong>Género:</strong> {{ $artista->genero }}</p>

            @if (auth()->check() && auth()->user()->id != $user->id)
                @if (auth()->user()->artistasFavoritos()->where('id_artista', $artista->id)->exists())
                    <form action="{{ route('usuarios.artistas.eliminar_favorito', ['usuario' => auth()->user(), 'artista' => $artista]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar de favoritos</button>
                    </form>
                @else
                    <form action="{{ route('usuarios.artistas.agregar_favorito', ['usuario' => auth()->user(), 'artista' => $artista]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Agregar a favoritos</button>
                    </form>
                @endif
            @endif
        @endif

        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar Perfil</a>

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

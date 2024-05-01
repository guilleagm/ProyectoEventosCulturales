 <div class="container">
        <h1>Perfil de Usuario</h1>
        <div class="profile">
            <p><strong>Nombre de Usuario:</strong> {{ $user->nombre_usuario }}</p>
            <p><strong>Correo:</strong> {{ $user->correo }}</p>
            @if ($artista)
                <h2>Datos del Artista</h2>
                <p><strong>Nombre Artístico:</strong> {{ $artista->nombre }}</p>
                <p><strong>Biografía:</strong> {{ $artista->biografia }}</p>
                <p><strong>Género:</strong> {{ $artista->genero }}</p>
            @endif
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar Perfil</a>
            @if (auth()->check() && auth()->user()->esAdmin)
                <form action="{{ route('users.eliminarUsuario', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
                </form>
            @endif
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
            </form>
        </div>
</div>

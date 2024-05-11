<link rel="stylesheet" href="/css/estilos1.css">
<div class="container">
    @include('menu')
    <h1>Perfil de Usuario</h1>
    <div class="profile">
        <!-- Display the profile image -->
        @if ($user->imagen)
            <img src="{{ asset('images/users/' . $user->imagen) }}" alt="Imagen de {{ $user->nombre_usuario }}" class="profile-image">
        @else
            <p><strong>Imagen:</strong> No hay imagen de perfil disponible</p>
        @endif

        <p><strong>Nombre de Usuario:</strong> {{ $user->nombre_usuario }}</p>
        <p><strong>Correo:</strong> {{ $user->correo }}</p>

        <!-- Artist details, only shown if the profile belongs to an artist -->
        @if ($artista)
            <div class="artist-details">
                <h2>Datos del Artista</h2>
                <p><strong>Nombre Artístico:</strong> <a href="{{ route('users.profile', $artista->id) }}">{{ $artista->nombre }}</a></p>
                <p><strong>Biografía:</strong> {{ $artista->biografia }}</p>
                <p><strong>Género:</strong> {{ $artista->genero }}</p>
            </div>
            <!-- Add/remove favorite artist -->
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

        <!-- Button to register as artist, shown only if the logged-in user is viewing their own profile and they are not an artist -->
        @if ($puedeRegistrarArtista)
            <a href="{{ route('registro.artista') }}" class="btn btn-primary">Registrarse como artista</a><br>
        @endif
        @if($esArtistaLogueado)
            <a href="{{ route('programarEvento') }}">Programar Evento</a><br>
        @endif

        <!-- Edit profile link -->
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar Perfil</a>

        <!-- Admin options to delete another user -->
        @if (auth()->check() && auth()->user()->esAdmin && auth()->user()->id != $user->id)
            <form action="{{ route('users.eliminarUsuario', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
            </form>
        @endif

        <!-- User options to delete own account -->
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

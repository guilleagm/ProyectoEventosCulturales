<div class="container">
    <h2>Editar Perfil</h2>
    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre_usuario">Nombre de Usuario:</label>
            <input type="text" name="nombre_usuario" class="form-control" value="{{ $user->nombre_usuario }}" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" name="correo" class="form-control" value="{{ $user->correo }}" required>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen de Perfil (Opcional):</label>
            <input type="file" name="imagen" accept="image/*" class="form-control">
        </div>
        @if ($esArtista)
            <div class="form-group">
                <label for="nombre">Nombre Artístico:</label>
                <input id="nombre" name="nombre" class="form-control" value="{{ $artista->nombre }}">
            </div>
            <div class="form-group">
                <label for="biografia">Biografía:</label>
                <textarea id="biografia" name="biografia" class="form-control">{{ $artista->biografia }}</textarea>
            </div>
            <div class="form-group">
                <label for="genero">Género:</label>
                <input id="genero" name="genero" class="form-control" value="{{ $artista->genero }}">
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
    </form>
</div>

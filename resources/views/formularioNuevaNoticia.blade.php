<div class="container">
    <h2>Crear Noticia</h2>
    <form method="POST" action="{{ route('noticias.store') }}">
        @csrf
        <div class="form-group">
            <label for="texto">Texto de la Noticia:</label>
            <textarea name="texto" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="id_artista">Artista:</label>
            <select name="id_artista" class="form-control" required>
                @foreach(App\Models\Artista::all() as $artista)
                    <option value="{{ $artista->id }}">{{ $artista->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_usuario">Usuario:</label>
            <select name="id_usuario" class="form-control" required>
                @foreach(App\Models\User::all() as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre_usuario }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Publicar Noticia</button>
    </form>
</div>
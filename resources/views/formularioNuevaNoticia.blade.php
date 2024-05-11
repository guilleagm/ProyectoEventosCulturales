<link rel="stylesheet" href="/css/estilos1.css">
@auth
    @if (Auth::user()->esAdmin)
<div class="container">
    <h2>Crear Noticia</h2>
    <form method="POST" action="{{ route('noticias.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="texto">Texto de la Noticia:</label>
            <textarea name="texto" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" class="form-control" required>
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
    @endif
@endauth

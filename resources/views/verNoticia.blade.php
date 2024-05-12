<link rel="stylesheet" href="/css/estilos1.css">
<div class="container">
    @include('menu')
    <h1>{{ $noticia->titulo }}</h1>
    <img src="{{ asset('/images/' . $noticia->imagen) }}" alt="Imagen de {{ $noticia->titulo }}" style="width:100%; max-width:600px;">
    <p><strong>Texto de la Noticia:</strong> {{ $noticia->texto }}</p>
    <p><strong>Artista ID:</strong> {{ $noticia->id_artista }}</p>
    <p><strong>Usuario ID:</strong> {{ $noticia->id_usuario }}</p>
</div>
@auth
    @if (auth()->user()->esAdmin)
        <a href="{{ route('noticias.edit', $noticia->id) }}" class="btn btn-primary">Editar Noticia</a>
        <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar Noticia</button>
        </form>
    @endif
@endauth
@include('pie')

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
    <h1>{{ $noticia->titulo }}</h1>
    <img src="{{ asset('/images/' . $noticia->imagen) }}" alt="Imagen de {{ $noticia->titulo }}" id="imagenNoticia">
    <p><strong>Artista:</strong> <a class="subra" href="{{ route('users.profile', ['id' => $noticia->artista->usuario->id]) }}">
            {{ $noticia->artista->usuario->nombre_usuario }}
        </a></p>
    <p id="texto">{{ $noticia->texto }}</p>
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

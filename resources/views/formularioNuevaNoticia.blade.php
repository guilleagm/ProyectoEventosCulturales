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
@include('pie')

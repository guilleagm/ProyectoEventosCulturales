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
        <div class="grupo-form">
            <label for="titulo">Título:</label><br>
            <input type="text" name="titulo" id="titulo" class="input-form" required>
        </div>
        <div class="grupo-form">
            <label for="texto">Texto de la Noticia:</label><br>
            <textarea name="texto" class="input-form" required></textarea>
        </div>
        <div class="grupo-form">
            <label for="imagen">Imagen:</label><br>
            <input type="file" name="imagen" class="input-form" required>
        </div>
        <div class="grupo-form">
            <label for="id_artista">Artista:</label><br>
            <select name="id_artista" class="input-form" required>
                @foreach(App\Models\Artista::all() as $artista)
                    <option value="{{ $artista->id }}">{{ $artista->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="grupo-form">
            <label for="id_usuario">Usuario:</label><br>
            <select name="id_usuario" class="input-form" required>
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

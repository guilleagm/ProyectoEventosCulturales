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
    <h1>Editar Noticia</h1>
    <form method="POST" action="{{ route('noticias.update', $noticia->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grupo-form">
            <label for="titulo">Título:</label><br>
            <input type="text" name="titulo" id="titulo" class="input-form" value="{{ old('titulo', $noticia->titulo) }}" required>
        </div>
        <div class="grupo-form">
            <label for="texto">Texto:</label><br>
            <textarea name="texto" id="texto" class="input-form" rows="5" required>{{ old('texto', $noticia->texto) }}</textarea>
        </div>
        <div class="grupo-form">
            <label for="imagen">Imagen (opcional):</label><br>
            <input type="file" name="imagen" class="input-form">
        </div>
        <div class="grupo-form">
            <label for="id_artista">ID del Artista:</label><br>
            <input type="number" name="id_artista" id="id_artista" class="input-form" value="{{ old('id_artista', $noticia->id_artista) }}" required>
        </div>
        <div class="grupo-form">
            <label for="id_usuario">ID del Usuario:</label><br>
            <input type="number" name="id_usuario" id="id_usuario" class="input-form" value="{{ old('id_usuario', $noticia->id_usuario) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Noticia</button>
    </form>
</div>
@include('pie')

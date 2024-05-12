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
        <h2>Registro de Artista</h2>
        <form method="POST" action="{{ route('registro.artista.submit') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre Artístico:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="biografia">Biografía:</label>
                <textarea name="biografia" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="genero">Género Musical:</label>
                <input type="text" name="genero" class="form-control" required>
            </div>
            <input type="hidden" name="id_usuario" value="{{ Auth::id() }}">
            <button type="submit" class="btn btn-primary">Registrarse como Artista</button>
        </form>
    </div>
@endauth
@include('pie')

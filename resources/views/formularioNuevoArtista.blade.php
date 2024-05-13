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
            <div class="grupo-form">
                <label for="nombre">Nombre Artístico:</label><br>
                <input type="text" name="nombre" class="input-form" required>
            </div>
            <div class="grupo-form">
                <label for="biografia">Biografía:</label><br>
                <textarea name="biografia" class="input-form" rows="4" required></textarea>
            </div>
            <div class="grupo-form">
                <label for="genero">Género Musical:</label><br>
                <input type="text" name="genero" class="input-form" required>
            </div>
            <input type="hidden" name="id_usuario" value="{{ Auth::id() }}">
            <button type="submit" class="btn btn-primary">Registrarse como Artista</button>
        </form>
    </div>
@endauth
@include('pie')

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
    <h1>Cambiar Contraseña</h1>
    <form method="POST" action="{{ route('user.cambiar-contraseña') }}">
        @csrf
        <div class="grupo-form">
            <label for="current_password">Contraseña Actual:</label><br>
            <input type="password" class="input-form" id="current_password" name="current_password" required>
        </div>
        <div class="grupo-form">
            <label for="new_password">Nueva Contraseña:</label><br>
            <input type="password" class="input-form" id="new_password" name="new_password" required>
        </div>
        <div class="grupo-form">
            <label for="new_password_confirmation">Confirmar Nueva Contraseña:</label><br>
            <input type="password" class="input-form" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
    </form>
</div>
@include('pie')
</div>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CulturaVibe</title>
    <link rel="stylesheet" href="{{ asset('css/estilos1.css') }}">
    <script src="/js/menuFotoPerfil.js"></script>
    <script src="/js/hamburguesa.js"></script>
</head>
<body>
<div class="container">
    @include('menu')
    @if (Auth::user()->esAdmin)
    <h1>Crear Nueva Sede</h1>
    <form method="POST" action="{{ route('sedes.store') }}">
        @csrf
        <div class="grupo-form">
        <label for="nombre">Nombre:</label><br>
        <input type="text" class="input-form" name="nombre" required><br>
        </div>
        <div class="grupo-form">
        <label for="dirección">Dirección:</label><br>
        <input type="text" class="input-form" name="dirección" required><br>
        </div>
        <div class="grupo-form">
        <label for="capacidad">Capacidad:</label><br>
        <input type="number" class="input-form" name="capacidad" required><br>
        </div>
        <div class="grupo-form">
        <label for="accesibilidad">Accesibilidad:</label><br>
        <select name="accesibilidad" class="input-form">
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select><br>
        </div>
        <button type="submit" class="btn btn-primary">Crear Sede</button>
    </form>
</div>
@else
    @include('prohibir')
    @endif
@if(Auth::user()->esAdmin)
    @include('pie')
@endif
</body>

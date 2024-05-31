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
    <h2>Editar Sede</h2>
    <form method="POST" action="{{ route('sedes.actualizar', $sede->id) }}">
        @csrf
        @method('PUT')
        <div class="grupo-form">
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" id="nombre" class="input-form" value="{{ $sede->nombre }}" required>
        </div>
        <div class="grupo-form">
            <label for="dirección">Dirección:</label><br>
            <input type="text" name="dirección" id="dirección" class="input-form" value="{{ $sede->dirección }}" required>
        </div>
        <div class="grupo-form">
            <label for="capacidad">Capacidad:</label><br>
            <input type="number" name="capacidad" id="capacidad" class="input-form" value="{{ $sede->capacidad }}" required>
        </div>
        <div class="grupo-form">
            <label for="accesibilidad">Accesibilidad:</label><br>
            <select name="accesibilidad" id="accesibilidad" class="input-form" required>
                <option value="1" {{ $sede->accesibilidad ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$sede->accesibilidad ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Sede</button>ç
    </form>
</div>
@else
    @include('prohibir')
@endif
@if(Auth::user()->esAdmin)
    @include('pie')
@endif
</body>


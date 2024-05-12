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
    <h2>Editar Sede</h2>
    <form method="POST" action="{{ route('sedes.actualizar', $sede->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $sede->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="dirección">Dirección:</label>
            <input type="text" name="dirección" id="dirección" class="form-control" value="{{ $sede->dirección }}" required>
        </div>
        <div class="form-group">
            <label for="capacidad">Capacidad:</label>
            <input type="number" name="capacidad" id="capacidad" class="form-control" value="{{ $sede->capacidad }}" required>
        </div>
        <div class="form-group">
            <label for="accesibilidad">Accesibilidad:</label>
            <select name="accesibilidad" id="accesibilidad" class="form-control" required>
                <option value="1" {{ $sede->accesibilidad ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$sede->accesibilidad ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Actualizar Sede</button>
    </form>
</div>
@include('pie')

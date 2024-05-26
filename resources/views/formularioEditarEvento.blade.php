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
    <h1>Editar Evento</h1>
    <form action="{{ route('eventos.actualizar', $evento->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grupo-form">
        <label for="titulo">Título:</label><br>
        <input type="text" class="input-form" name="titulo" value="{{ $evento->titulo }}" required>
        </div>
        <br>
        <div class="grupo-form">
        <label for="fecha">Fecha:</label><br>
        <input type="date" class="input-form" name="fecha" value="{{ $evento->fecha }}" required>
        </div>
        <br>
        <div class="grupo-form">
            <label for="hora">Hora del Evento:</label><br>
            <input type="time" name="hora" class="input-form" required>
        </div>
        <br>
        <div class="grupo-form">
            <label for="categoria">Categoría:</label><br>
            <select name="categoria" class="input-form" required>
                <option value="Concierto">Concierto</option>
                <option value="Teatro">Teatro</option>
                <option value="Recital de Poesía">Recital de Poesía</option>
            </select>
        </div>
        <br>
        <div class="grupo-form">
        <label for="estado">Estado:</label><br>
        <select name="estado" class="input-form" required>
            <option value="En preparación" {{ $evento->estado == 'En preparación' ? 'selected' : '' }}>En preparación</option>
            <option value="Cancelado" {{ $evento->estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
            <option value="Terminado" {{ $evento->estado == 'Terminado' ? 'selected' : '' }}>Terminado</option>
        </select>
        </div>
        <br>
        <div class="grupo-form">
        <label for="imagen">Cambiar Imagen (Opcional):</label><br>
        <input type="file" class="input-form" name="imagen" accept="image/*">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Actualizar Evento</button>
    </form>
</div>
@include('pie')

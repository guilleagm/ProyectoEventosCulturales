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
    @auth
    <h1>Programar Nuevo Evento</h1>
    <form method="POST" action="{{ route('storeEvento') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_usuario" value="{{ Auth::id() }}">
        <div class="grupo-form">
            <label for="titulo">Título del Evento:</label><br>
            <input type="text" name="titulo" class="input-form" required>
        </div>
        <div class="grupo-form">
            <label for="fecha">Fecha del Evento:</label><br>
            <input type="date" name="fecha" class="input-form" required>
        </div>
        <div class="grupo-form">
            <label for="hora">Hora del Evento:</label><br>
            <input type="time" name="hora" class="input-form" required>
        </div>
        <div class="grupo-form">
            <label for="categoria">Categoría:</label><br>
            <select name="categoria" class="input-form" required>
                <option value="Concierto">Concierto</option>
                <option value="Teatro">Teatro</option>
                <option value="Recital de Poesía">Recital de Poesía</option>
            </select>
        </div>
        <div class="grupo-form">
            <label for="estado">Estado:</label><br>
            <select name="estado" class="input-form" required>
                <option value="En preparación">En preparación</option>
                <option value="Cancelado">Cancelado</option>
                <option value="Terminado">Terminado</option>
            </select>
        </div>
        <div class="grupo-form">
            <label for="descripcion">Descripción del evento:</label><br>
            <textarea name="descripcion" class="input-form" required></textarea>
        </div>
        <div class="grupo-form">
            <label for="id_sede">Sede:</label><br>
            <select name="id_sede" class="input-form" required>
                @foreach($sedes as $sede)
                    <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="grupo-form">
            <label for="imagen">Imagen del Evento:</label>
            <input type="file" name="imagen" class="input-form" required>
        </div>
        <button type="submit" class="btn btn-primary">Programar Evento</button>
    </form>
</div>
@endauth
@include('pie')
</body>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CulturaVibe</title>
    <link rel="stylesheet" href="{{ asset('css/estilos1.css') }}">
    <script src="/js/filtradoEventos.js" ></script>
    <script src="/js/menuFotoPerfil.js"></script>
    <script src="/js/limpiarFiltros.js"></script>
</head>
<div class="container">
    @include('menu')
    <h1>Eventos</h1>

    <form id="filter-form" action="{{ route('eventos.filtrar') }}" method="GET">
        <label for="categoria">Filtrar por Categoría:</label><br>
        <select name="categoria" id="categoria" class="btn btn-primary">
            <option value="">Todas las Categorías</option>
            <option value="concierto">Concierto</option>
            <option value="teatro">Teatro</option>
            <option value="recital de poesía">Recital de Poesía</option>
        </select>
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <button type="button" id="clear-filters" class="btn btn-primary">Limpiar Filtros</button>
    </form>

    <div class="view-options">
        <button class="view-button" data-view="2">II</button>
        <button class="view-button" data-view="3">III</button>
        <button class="view-button" data-view="list">=</button>
    </div>
    <br>
    <div class="event-container">
        @foreach ($eventos as $evento)
            <div class="event-item">
                <img src="{{ asset('images/' . $evento->imagen) }}" alt="{{ $evento->titulo }}">
                <h2><a href="{{ route('eventos.ver', $evento->id) }}">{{ $evento->titulo }}</a></h2>
                <div>{{ $evento->categoria }}</div>
                <div>{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }} - {{ $evento->hora}}</div>
                <div>📍{{ $evento->sede->nombre }}</div>
                <div>Entradas disponibles: {{ $evento->num_entradas_disponibles }}</div>
            </div>
        @endforeach
    </div>
    <div id="paginador">
        {{ $eventos->links() }}
    </div>
</div>
@include('pie')

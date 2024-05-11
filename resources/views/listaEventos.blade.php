<head>
    <link rel="stylesheet" href="{{ asset('css/estilos1.css') }}">
    <script src="/js/filtradoEventos.js" ></script>
</head>
<div class="container">
    @include('menu')
    <h1>Eventos</h1>

    <form action="{{ route('eventos.filtrar') }}" method="GET">
        <label for="categoria">Filtrar por Categoría:</label>
        <select name="categoria" id="categoria">
            <option value="">Todas las Categorías</option>
            <option value="concierto">Concierto</option>
            <option value="teatro">Teatro</option>
            <option value="recital de poesía">Recital de Poesía</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <div class="view-options">
        <button class="view-button" data-view="2">II</button>
        <button class="view-button" data-view="3">III</button>
        <button class="view-button" data-view="list">=</button>
    </div>

    <div class="event-container">
        @foreach ($eventos as $evento)
            <div class="event-item">
                <img src="{{ asset('images/' . $evento->imagen) }}" alt="{{ $evento->titulo }}">
                <div><a href="{{ route('eventos.ver', $evento->id) }}">{{ $evento->titulo }}</a></div>
                <div>{{ $evento->fecha }}</div>
                <div>{{ $evento->id_sede }}</div>
                <div>{{ $evento->estado }}</div>
                <div>{{ $evento->num_entradas_disponibles }}</div>
                <div>{{ $evento->categoria }}</div>
            </div>
        @endforeach
    </div>
</div>
@include('pie')

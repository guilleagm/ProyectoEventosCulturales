<link rel="stylesheet" href="/css/estilos1.css">
<div class="container">
    <h1>Lista de Eventos</h1>

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

    <table>
        <thead>
        <tr>
            <th>Título</th>
            <th>Fecha</th>
            <th>ID Sede</th>
            <th>Estado</th>
            <th>Num entradas disponibles</th>
            <th>Categoría</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($eventos as $evento)
            <tr>
                <td><a href="{{ route('eventos.ver', $evento->id) }}">{{ $evento->titulo }}</a></td>
                <td>{{ $evento->fecha }}</td>
                <td>{{ $evento->id_sede }}</td>
                <td>{{ $evento->estado }}</td>
                <td>{{ $evento->num_entradas_disponibles }}</td>
                <td>{{ $evento->categoria }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="container">
    <h1>Lista de Eventos</h1>
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
            <td>{{ $evento->fecha}}</td>
            <td>{{ $evento->id_sede }}</td>
            <td>{{ $evento->estado }}</td>
            <td>{{ $evento->num_entradas_disponibles }}</td>
            <td>{{ $evento->categoria }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

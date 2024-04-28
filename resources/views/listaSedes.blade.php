<div class="container">
    <h1>Lista de Sedes</h1>
    <table>
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Capacidad</th>
            <th>Accesibilidad</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sedes as $sede)
            <tr>
                <td>{{ $sede->nombre }}</td>
                <td>{{ $sede->dirección }}</td>
                <td>{{ $sede->capacidad }}</td>
                <td>{{ $sede->accesibilidad ? 'Sí' : 'No' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

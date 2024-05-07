<div class="container">
    <h1>Detalles de la Sede</h1>
    <div>
        <p><strong>Nombre:</strong> {{ $sede->nombre }}</p>
        <p><strong>Dirección:</strong> {{ $sede->dirección }}</p>
        <p><strong>Capacidad:</strong> {{ $sede->capacidad }}</p>
        <p><strong>Accesibilidad:</strong> {{ $sede->accesibilidad ? 'Sí' : 'No' }}</p>
    </div>
    <a href="{{ route('sedes.listaSedes') }}" class="btn btn-primary">Volver a la lista de Sedes</a>
    <a href="{{ route('sedes.editar', $sede->id) }}" class="btn btn-warning">Editar Sede</a>
</div>

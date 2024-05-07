<link rel="stylesheet" href="/css/estilos1.css">
<div class="container">
    <h1>Confirmar Cancelación</h1>
    <p>Estás a punto de cancelar la compra de las entradas para el evento: {{ $evento->titulo }}</p>

    <form action="{{ route('entradas.cancelar', ['idEvento' => $evento->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Confirmar Cancelación</button>
    </form>
    <a href="{{ route('eventos.ver', $evento->id) }}" class="btn btn-secondary">Volver</a>
</div>

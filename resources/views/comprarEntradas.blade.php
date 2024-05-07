<link rel="stylesheet" href="/css/estilos1.css">
<div class="container">
    <h1>Compra de Entradas para: {{ $evento->titulo }}</h1>
    <form method="POST" action="{{ route('entradas.comprar', ['evento' => $evento->id]) }}">
        @csrf
        <div class="form-group">
            <label for="num_entradas_asignadas">Cantidad de Entradas:</label>
            <input type="number" class="form-control" id="num_entradas_asignadas" name="num_entradas_asignadas" required>
        </div>
        <button type="submit" class="btn btn-primary">Comprar Entradas</button>
    </form>
</div>

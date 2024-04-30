<div class="container">
    <h1>Editar Evento</h1>
    <form action="{{ route('eventos.actualizar', $evento->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="{{ $evento->titulo }}" required>
        <br>
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" value="{{ $evento->fecha}}" required>
        <br>
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" value="{{ $evento->categoria }}" required>
        <br>
        <label for="num_entradas_disponibles">Número de Entradas Disponibles:</label>
        <input type="number" name="num_entradas_disponibles" value="{{ $evento->num_entradas_disponibles }}" class="form-control" required>
        <br>
        <label for="estado">Estado:</label>
        <select name="estado" class="form-control" required>
            <option value="En preparación">En preparación</option>
            <option value="Cancelado">Cancelado</option>
            <option value="Terminado">Terminado</option>
        </select>
        <br>
        <label for="id_sede">ID Sede:</label>
        <input type="number" name="id_sede" value="{{ $evento->id_sede }}" required>
        <br>
        <button type="submit">Actualizar Evento</button>
    </form>
</div>

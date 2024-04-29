<div class="container">
    <h1>Programar Nuevo Evento</h1>
    <form method="POST" action="{{ route('storeEvento') }}">
        @csrf
        <div class="form-group">
            <label for="titulo">Título del Evento:</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha del Evento:</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="categoria">Categoría:</label>
            <input type="text" name="categoria" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="num_entradas_disponibles">Número de Entradas Disponibles:</label>
            <input type="number" name="num_entradas_disponibles" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select name="estado" class="form-control" required>
                <option value="En preparación">En preparación</option>
                <option value="Cancelado">Cancelado</option>
                <option value="Terminado">Terminado</option>
            </select>
        </div>
        <div class="form-group">
            <label for="id_sede">ID de la Sede:</label>
            <input type="number" name="id_sede" class="form-control" required>
        </div>
        <!-- Agrega aquí más campos del formulario según tus necesidades -->
        <button type="submit" class="btn btn-primary">Programar Evento</button>
    </form>
</div>

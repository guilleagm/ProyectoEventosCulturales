<body>
<div class="container">
    <h1>{{ $evento->titulo }}</h1>
    <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
    <p><strong>Fecha:</strong> {{ $evento->fecha }}</p>
    <p><strong>ID Sede:</strong> {{ $evento->id_sede }}</p>
    <p><strong>Estado:</strong> {{ $evento->estado }}</p>
    <p><strong>Número de Entradas Disponibles:</strong> {{ $evento->num_entradas_disponibles }}</p>
    <p><strong>Categoría:</strong> {{ $evento->categoria }}</p>
    <a href="{{ route('eventos.editar', $evento->id) }}" class="btn btn-primary">Editar Evento</a>
    <a href="{{ route('entradas.mostrar_compra', $evento->id) }}" class="btn btn-primary">Comprar Entradas</a>
</div>

<div class="container">
    <h2>Comentarios</h2>
    @forelse ($comentarios as $comentario)
        <div class="comentario">
            <p><strong>Comentado por:</strong> {{ $comentario->usuario->nombre_usuario}}</p>
            <p><strong>Contenido:</strong> {{ $comentario->contenido }}</p>
            <p><strong>Valoración:</strong> {{ $comentario->valoracion }} estrellas</p>
            <p><strong>Fecha del comentario:</strong> {{ $comentario->created_at}}</p>
        </div>
    @empty
        <p>No hay comentarios para este evento.</p>
    @endforelse
</div>

<div class="container">
    <form action="{{ route('eventos.guardar_comentario', $evento->id) }}" method="POST">
        @csrf
        <div>
            <label for="contenido">Comentario:</label>
            <textarea id="contenido" name="contenido" required></textarea>
        </div>
        <div>
            <label for="valoracion">Valoración:</label>
            <select id="valoracion" name="valoracion" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <button type="submit">Enviar Comentario</button>
    </form>
</div>

</body>

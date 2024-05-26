<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CulturaVibe</title>
    <link rel="stylesheet" href="{{ asset('css/estilos1.css') }}">
    <script src="/js/menuFotoPerfil.js"></script>
    <script src="/js/comentarios.js"></script>
</head>
<body>
<div class="container">
    @include('menu')
    <h1>{{ $evento->titulo }}</h1>

    @if ($evento->imagen)
        <img src="{{ asset('images/' . $evento->imagen) }}" alt="Imagen del Evento" class="img-fluid">
    @else
        <p>No hay imagen disponible para este evento.</p>
    @endif

    <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
    <p><strong>Fecha:</strong> {{ $evento->fecha }}</p>
    <p><strong>📍Sede:</strong> {{ $evento->sede->nombre }}</p>
    <p><strong>Estado:</strong> {{ $evento->estado }}</p>
    <p><strong>Número de Entradas Disponibles:</strong> {{ $evento->num_entradas_disponibles }}</p>
    <p><strong>Categoría:</strong> {{ $evento->categoria }}</p>
    @if(auth()->check() && (auth()->user()->esAdmin || auth()->id() == $evento->id_usuario))
        <form method="POST" action="{{ route('eventos.cancel', $evento->id) }}" onsubmit="return confirm('¿Estás seguro de que quieres cancelar este evento?');">
            @csrf
            <button type="submit" class="btn btn-danger">Cancelar Evento</button>
        </form>
    @endif
    <br>
    <a href="{{ route('eventos.editar', $evento->id) }}" class="btn btn-primary">Editar Evento</a>
    @if(!$usuarioHaComprado)
        <a href="{{ route('entradas.mostrar_compra', $evento->id) }}" class="btn btn-primary">Comprar Entradas</a>
    @endif
    @if($usuarioHaComprado)
    <a href="{{ route('entradas.confirmar_cancelacion', $evento->id) }}" class="btn btn-primary">Devolver Entradas</a>
    @endif
</div>

<div class="container">
    <h2>Comentarios</h2>
    <div id="comentarios-container">
        @foreach ($comentarios as $index => $comentario)
            <div class="comentario{{ $index >= 2 ? ' oculto' : '' }}">
                <p><strong>Comentado por:</strong> <a href="{{ route('users.profile', $comentario->usuario->id) }}">{{ $comentario->usuario->nombre_usuario }}</a></p>
                <p><strong>Contenido:</strong> {{ $comentario->contenido }}</p>
                <p><strong>Valoración:</strong> {{ $comentario->valoracion }} estrellas</p>
                <p><strong>Fecha del comentario:</strong> {{ $comentario->created_at }}</p>
            </div>
        @endforeach
    </div>
    @if(count($comentarios) > 2)
        <button id="show-more-comments" class="btn btn-primary">Mostrar más comentarios</button>
    @endif
</div>

<div class="container">
    <form action="{{ route('eventos.guardar_comentario', $evento->id) }}" method="POST">
        @csrf
        <div class="grupo-form">
            <label for="contenido">Comentario:</label><br>
            <textarea id="contenido" class="input-form" name="contenido" required></textarea>
        </div>
        <div class="grupo-form">
            <label for="valoracion">Valoración:</label><br>
            <select id="valoracion" class="input-form" name="valoracion" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Comentario</button>
    </form>
</div>
</body>
@include('pie')

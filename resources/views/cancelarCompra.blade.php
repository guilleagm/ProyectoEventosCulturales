<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CulturaVibe</title>
    <link rel="stylesheet" href="{{ asset('css/estilos1.css') }}">
    <script src="/js/menuFotoPerfil.js"></script>
    <script src="/js/hamburguesa.js"></script>
</head>
<body>
<div class="container">
    @include('menu')
    <h1>Confirmar Cancelación</h1>
    <p>Estás a punto de cancelar la compra de las entradas para el evento: {{ $evento->titulo }}</p>

    <form action="{{ route('entradas.cancelar', ['idEvento' => $evento->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Confirmar Cancelación</button>
    </form>
    <a href="{{ route('eventos.ver', $evento->id) }}" class="btn btn-secondary">Volver</a>
</div>
@include('pie')
</body>

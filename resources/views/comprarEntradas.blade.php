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
    @auth
    <h1>Compra de Entradas para: {{ $evento->titulo }}</h1>
    <form method="POST" action="{{ route('entradas.comprar', ['evento' => $evento->id]) }}">
        @csrf
        <div class="grupo-form">
            <label for="num_entradas_asignadas">Cantidad de Entradas:</label>
            <input type="number" class="input-form" id="num_entradas_asignadas" name="num_entradas_asignadas" min="1" max="5" required>
        </div>
        <button type="submit" class="btn btn-primary">Comprar Entradas</button>
    </form>
    @endauth
</div>
@include('pie')
</body>

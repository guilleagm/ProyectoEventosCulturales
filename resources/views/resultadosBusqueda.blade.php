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
    <h1>Resultados para la Búsqueda de "{{ $busqueda }}"</h1>
    @if ($eventos->isEmpty())
        <p>No se encontraron eventos para el usuario "{{ $busqueda }}".</p>
    @else
        <div class="resultado">
            <ul>
                @foreach ($eventos as $evento)
                    <li>
                        <img src="{{ asset('images/' . $evento->imagen) }}" alt="{{ $evento->titulo }}">
                        <h3><a href="{{ route('eventos.ver', $evento->id) }}">{{ $evento->titulo }}</a></h3>
                        - {{ $evento->fecha }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@include('pie')
</body>

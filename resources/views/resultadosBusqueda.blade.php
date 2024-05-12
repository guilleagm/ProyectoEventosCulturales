<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CulturaVibe</title>
    <link rel="stylesheet" href="{{ asset('css/estilos1.css') }}">
    <script src="/js/menuFotoPerfil.js"></script>
</head>
<body>
<div class="container">
    @include('menu')
    <h1>Resultados de la Búsqueda para "{{ $busqueda }}"</h1>
    @if ($eventos->isEmpty())
        <p>No se encontraron eventos para el usuario "{{ $busqueda }}".</p>
    @else
        <ul>
            @foreach ($eventos as $evento)
                <li>
                    <a href="{{ route('eventos.ver', $evento->id) }}">{{ $evento->titulo }}</a>
                    - {{ $evento->fecha }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
@include('pie')

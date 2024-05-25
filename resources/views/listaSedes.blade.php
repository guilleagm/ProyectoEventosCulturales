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
    <h1>Lista de Sedes</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Capacidad</th>
            <th>Accesibilidad</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sedes as $sede)
            <tr>
                <td><a href="{{ route('sedes.ver', $sede->id) }}">{{ $sede->nombre }}</a></td>
                <td>{{ $sede->dirección }}</td>
                <td>{{ $sede->capacidad }}</td>
                <td>{{ $sede->accesibilidad ? 'Sí' : 'No' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@include('pie')

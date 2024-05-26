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
    <h1>Detalles de la Sede</h1>
    <div>
        <p><strong>Nombre:</strong> {{ $sede->nombre }}</p>
        <p><strong>Dirección:</strong> {{ $sede->dirección }}</p>
        <p><strong>Capacidad:</strong> {{ $sede->capacidad }}</p>
        <p><strong>Accesibilidad:</strong> {{ $sede->accesibilidad ? 'Sí' : 'No' }}</p>
    </div>
    <a href="{{ route('sedes.listaSedes') }}" class="btn btn-primary">Volver a la lista de Sedes</a>
    <a href="{{ route('sedes.editar', $sede->id) }}" class="btn btn-primary">Editar Sede</a>
</div>
@include('pie')

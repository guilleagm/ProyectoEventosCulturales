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
        @if(Auth::user()->esAdmin)
    <h1>Detalles de la Sede</h1>
    <div>
        <p><strong>Nombre:</strong> {{ $sede->nombre }}</p>
        <p><strong>Dirección:</strong> {{ $sede->dirección }}</p>
        <p><strong>Capacidad:</strong> {{ $sede->capacidad }}</p>
        <p><strong>Accesibilidad:</strong> {{ $sede->accesibilidad ? 'Sí' : 'No' }}</p>
    <a href="{{ route('sedes.editar', $sede->id) }}" class="btn btn-primary">Editar Sede</a><br><br>
        <form action="{{ route('sedes.eliminar', $sede->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar Sede</button>
        </form>
</div>
@else
    @include('prohibir')
@endif
    @include('pie')
@endauth
</body>

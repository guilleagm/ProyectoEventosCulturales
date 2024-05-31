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
@if (Auth::user()->esAdmin)
    <section class="admin-section">
        <nav class="admin-navigation">
            <a href="{{ route('formNuevaSede') }}">Crear Nueva Sede</a>
            <a href="{{ route('formNuevaNoticia') }}">Generar Noticia</a>
            <a href="{{ route('admin.users.index') }}">Lista usuarios</a>
            <a href="{{ route('sedes.listaSedes') }}">Lista sedes</a>
        </nav>
    </section>
    @else
        @include('prohibir')
    @endauth
    @else
        @include('prohibir')
    @endif
</div>
@include('pie')
</body>

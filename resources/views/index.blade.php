<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
<div class="container">
    <h1>Bienvenido a Nuestro Sitio</h1>
    <a href="{{ route('eventos.listar') }}">Lista Eventos</a>
@auth
        <p>Hola, {{ Auth::user()->nombre_usuario }}! Bienvenido de nuevo.</p>
        <a href="{{ route('users.profile', ['id' => Auth::id()]) }}">Ver perfil</a><br>
        <a href="{{ route('registro.artista') }}">Registrarse como artista</a><br>
        @if (Auth::user()->id == Auth::id()) <!-- Verifica si el id de usuario coincide con el id de la sesión -->
        <!-- Botón solo para artistas -->
        <a href="{{ route('programarEvento') }}">Programar Evento</a><br>
        @endif
        <a href="{{ route('logout') }}">Cerrar Sesión</a><br>
    @if (Auth::user()->esAdmin)
            <!-- Botones solo para administradores -->
            <a href="{{ route('formNuevaSede') }}">Crear Nueva Sede</a><br>
            <a href="{{ route('formNuevaNoticia') }}">Generar Noticia</a><br>
            <a href="{{ route('admin.users.index') }}">Lista usuarios</a><br>
        @endif
        <a href="{{ route('sedes.listaSedes') }}">Ver sedes</a><br>
        <a href="{{ route('logout') }}">Cerrar Sesión</a><br>
    @endauth

    @guest
        <p>Bienvenido, visitante! Considera <a href="{{ route('login') }}">iniciar sesión</a> o <a href="{{ route('register') }}">registrarte</a> para una mejor experiencia.</p>
    @endguest
</div>
</body>
</html>

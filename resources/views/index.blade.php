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

    @auth
        <p>Hola, {{ Auth::user()->nombre_usuario }}! Bienvenido de nuevo.</p>
        <a href="{{ route('logout') }}">Cerrar Sesión</a>
        <a href="/dashboard">Ir al Dashboard</a>
    @endauth

    @guest
        <p>Bienvenido, visitante! Considera <a href="{{ route('login') }}">iniciar sesión</a> o <a href="{{ route('register') }}">registrarte</a> para una mejor experiencia.</p>
    @endguest
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="/css/estilos1.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Bienvenido a Nuestro Sitio</h1>
        <nav>
            <a href="{{ route('eventos.listar') }}">Lista Eventos</a>
            <a href="{{ route('noticias.index') }}">Lista Noticias</a>
        </nav>
    </header>

    <main>
        <section>
            <form action="{{ route('eventos.buscar') }}" method="GET">
                <label for="artist-name">Buscar Eventos por Usuario:</label>
                <input type="text" name="artist-name" id="artist-name" placeholder="Nombre del usuario">
                <button type="submit">Buscar</button>
            </form>
        </section>

        @auth
            <section>
                <p>Hola, {{ Auth::user()->nombre_usuario }}! Bienvenido de nuevo.</p>
                <nav>
                    <a href="{{ route('users.profile', ['id' => Auth::id()]) }}">Ver perfil</a><br>
                    @if (!$esArtista)
                        <a href="{{ route('registro.artista') }}">Registrarse como artista</a><br>
                    @endif
                    @if (Auth::user()->id == Auth::id())
                        <a href="{{ route('programarEvento') }}">Programar Evento</a><br>
                    @endif
                    <a href="{{ route('logout') }}">Cerrar Sesión</a><br>
                </nav>
            </section>

            @if (Auth::user()->esAdmin)
                <section>
                    <nav>
                        <a href="{{ route('formNuevaSede') }}">Crear Nueva Sede</a><br>
                        <a href="{{ route('formNuevaNoticia') }}">Generar Noticia</a><br>
                        <a href="{{ route('admin.users.index') }}">Lista usuarios</a><br>
                    </nav>
                </section>
            @endif

            <section>
                <a href="{{ route('sedes.listaSedes') }}">Ver sedes</a><br>
                <a href="{{ route('logout') }}">Cerrar Sesión</a><br>
            </section>
        @endauth

        @guest
            <section>
                <p>Bienvenido, visitante! Considera <a href="{{ route('login') }}">iniciar sesión</a> o <a href="{{ route('register') }}">registrarte</a> para una mejor experiencia.</p>
            </section>
        @endguest
    </main>
</div>
</body>
</html>

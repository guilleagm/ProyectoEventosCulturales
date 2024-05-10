<header>
    <nav class="main-nav">
        <img src="/images/4.png" alt="Logo CulturaVibe" width="40">
        <div class="nav-logo">
            <h1><a href="{{ route('home') }}">CulturaVibe</a></h1>
        </div>
        <ul class="nav-items">
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li><a href="{{ route('eventos.listar') }}">Eventos</a></li>
            <li><a href="{{ route('noticias.index') }}">Noticias</a></li>
            @auth
            <li><a href="{{ route('users.profile', ['id' => Auth::id()]) }}">Perfil</a></li>
            <li><a href="{{ route('panelAdmin') }}">Panel Admin</a></li>
            @endauth
            <li class="search-form-container">
                <form action="{{ route('eventos.buscar') }}" method="GET" class="search-form">
                    <input type="text" name="artist-name" id="artist-name" placeholder="Buscar evento por artista">
                    <button type="submit" aria-label="Buscar artista">&#128269;</button>
                </form>
            </li>
        </ul>
    </nav>
    @auth()
    <nav class="logout-container">
        <a href="{{ route('logout') }}" class="logout-btn">Cerrar Sesión</a>
    </nav>
    @endauth
</header>

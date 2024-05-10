<header>
    <nav class="main-nav">
        <img src="/public/images/1.jpg" alt="Logo" width="40">
        <div class="nav-logo">
            <h1>CulturaVibe</h1>
        </div>
        <ul class="nav-items">
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li><a href="{{ route('eventos.listar') }}">Eventos</a></li>
            <li><a href="{{ route('noticias.index') }}">Noticias</a></li>
            <li><a href="{{ route('users.profile', ['id' => Auth::id()]) }}">Perfil</a></li>
            <li><a href="{{ route('panelAdmin') }}">Panel Admin</a></li>
            <li class="search-form-container">
                <form action="{{ route('eventos.buscar') }}" method="GET" class="search-form">
                    <input type="text" name="artist-name" id="artist-name" placeholder="Buscar evento por artista">
                    <button type="submit" aria-label="Buscar artista">&#128269;</button>
                </form>
            </li>
        </ul>
    </nav>
    <nav class="logout-container">
        <a href="{{ route('logout') }}" class="logout-btn">Cerrar Sesión</a>
    </nav>
</header>

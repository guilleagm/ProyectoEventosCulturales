<header>
    <nav class="main-nav">
        <img src="/images/4.png" alt="Logo CulturaVibe" width="40">
        <div class="nav-logo">
            <h1><a href="{{ route('home') }}">CulturaVibe</a></h1>
        </div>
        <button class="hamburger">&#9776;</button>
        <ul class="nav-items">
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li><a href="{{ route('eventos.listar') }}">Eventos</a></li>
            <li><a href="{{ route('noticias.index') }}">Noticias</a></li>
            <li class="search-form-container">
                <form action="{{ route('eventos.buscar') }}" method="GET" class="search-form">
                    <input type="text" name="artist-name" id="artist-name" placeholder="Buscar evento por artista">
                    <button type="submit" aria-label="Buscar artista">&#128269;</button>
                </form>
            </li>
        </ul>
        <ul>
            @auth
                <li class="profile-menu">
                    <img src="{{ asset('images/users/' . auth()->user()->imagen) }}" alt="Imagen de {{ auth()->user()->nombre_usuario }}" class="profile-image">
                    <div class="dropdown-content">
                        <a href="{{ route('users.profile', auth()->user()->id) }}">Ver Perfil</a>
                        @if(Auth::user()->esAdmin)
                            <a href="{{ route('panelAdmin') }}">Panel Admin</a>
                        @endif
                        <a href="{{ route('logout') }}">Cerrar Sesión</a>
                    </div>
                </li>
            @endauth
        </ul>
    </nav>
</header>

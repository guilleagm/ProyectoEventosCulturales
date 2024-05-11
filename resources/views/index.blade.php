<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CulturaVibe</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/estilos1.css') }}">
    <script src="/js/carousel.js"></script>
</head>
<body>
<div class="container">
    @include('menu')
    <main>
        @guest
            <section>
                <p>Bienvenido, visitante! Considera <a href="{{ route('login') }}">iniciar sesión</a> o <a href="{{ route('register') }}">registrarte</a> para una mejor experiencia.</p>
            </section>
        @endguest
        <section class="carousel-section">
            <h2>Próximos Eventos</h2>
            <div class="event-carousel">
                @if (isset($eventos))
                    @foreach ($eventos as $evento)
                        <div class="carousel-item">
                            <img src="{{ asset('images/' . $evento->imagen) }}" alt="{{ $evento->titulo }}">
                            <h3>{{ $evento->titulo }}</h3>
                            <p>{{ $evento->categoria }} - {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</p>
                            <a href="{{ route('eventos.ver', ['id' => $evento->id]) }}">Más información</a>
                        </div>
                    @endforeach
                @else
                    <p>No hay eventos disponibles.</p>
                @endif
            </div>
        </section>
            <section class="news-section">
                <h2>Últimas Noticias</h2>
                <div class="news-container">
                    @foreach ($noticias as $noticia)
                        <div class="news-item">
                            <img src="{{ asset('images/news/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}" class="news-image">
                            <div class="news-content">
                                <h3>{{ $noticia->titulo }}</h3>
                                <p>{{ $noticia->texto }}</p>
                                <a href="{{ route('noticias.show', ['id' => $noticia->id]) }}">Leer más</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
    </main>
</div>
@include('pie')
</body>
</html>

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
    <script src="/js/menuFotoPerfil.js"></script>
    <script src="/js/hamburguesa.js"></script>
</head>
<body>
<div class="container">
    @include('menu')
    <main>
        @guest
            <section>
                <p>Bienvenido! Considera <a href="{{ route('login') }}">iniciar sesión</a> o <a href="{{ route('register') }}">registrarte</a> para tener una experiencia completa.</p>
            </section>
        @endguest
        <section class="carousel-section">
            <h2>Próximos Eventos</h2>
            <div class="event-carousel">
                @if (isset($eventos))
                    @foreach ($eventos as $evento)
                        @if ($evento->estado === 'En preparación')
                        <div class="carousel-item">
                            <img src="{{ asset('images/' . $evento->imagen) }}" alt="{{ $evento->titulo }}">
                            <h3>{{ $evento->titulo }}</h3>
                            <p>{{ $evento->categoria }}</p>
                            <p>{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }} - {{ substr($evento->hora, 0, 5) }}</p>
                            <a href="{{ route('eventos.ver', ['id' => $evento->id]) }}">Más información</a>
                        </div>
                        @endif
                    @endforeach
                @else
                    <p>No hay eventos disponibles.</p>
                @endif
            </div>
        </section>
            <section class="texto-bienvenida">
                <h2>Bienvenido a Cultura Vibe</h2>
                <p>
                    Bienvenidos a Cultura Vibe, su portal de referencia para los eventos culturales más emocionantes en Zaragoza. Aquí, celebramos la vibrante escena artística que nuestra ciudad tiene para ofrecer, desde cautivadores conciertos, pasando por representaciones teatrales impresionantes, hasta íntimos recitales de poesía que prometen tocar el alma y despertar los sentidos.

                    <br>Nuestra misión en Cultura Vibe es conectar a los amantes del arte y la cultura con experiencias únicas que enriquezcan la vida social y cultural de nuestra comunidad. Zaragoza, con su rica historia y su dinámica vida cultural, es el telón de fondo perfecto para los eventos que curamos con pasión y dedicación.

                    <br>nvitamos a locales y visitantes a explorar nuestra oferta de eventos y a sumergirse en el arte y la cultura que define nuestra ciudad. Desde propuestas innovadoras hasta clásicos reinventados, Cultura Vibe es su entrada a experiencias memorables que esperan por usted.

                    <br>¡Explore, disfrute y deje que la vibrante cultura de Zaragoza le inspire!
                </p>
            </section>
            <section class="news-section">
                <h2>Últimas Noticias</h2>
                <div class="news-container">
                    @foreach ($noticias as $noticia)
                        <div class="news-item">
                            <img src="{{ asset('images/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}" class="news-image">
                            <div class="news-content">
                                <h3 class="p-limited">{{ $noticia->titulo }}</h3>
                                <p class="p-limited">{{ $noticia->texto }}</p>
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

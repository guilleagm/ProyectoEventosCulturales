<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias - CulturaVibe</title>
    <link rel="stylesheet" href="{{ asset('css/estilos1.css') }}">
    <script src="/js/menuFotoPerfil.js"></script>
    <script src="/js/hamburguesa.js"></script>
</head>
<body>
<div class="container">
    @include('menu')
    <h1>Noticias</h1>
    <div class="news-contenedor">
        @foreach ($noticias as $noticia)
            <div class="news-card">
                <img src="{{ asset('images/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}">
                <div class="news-info">
                    <h2><a href="{{ route('noticias.show', $noticia->id) }}">{{ $noticia->titulo }}</a></h2>
                    @if($noticia->artista && $noticia->artista->usuario)
                        Sobre:
                        <a href="{{ route('users.profile', ['id' => $noticia->artista->usuario->id]) }}">
                            {{ $noticia->artista->nombre }}
                        </a>
                    @else
                        <p>Nombre de usuario no disponible</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <br>
    <div id="paginador">
        {{ $noticias->links() }}
    </div>
</div>
@include('pie')
</body>
</html>

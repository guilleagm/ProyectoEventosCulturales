<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias - CulturaVibe</title>
    <link rel="stylesheet" href="{{ asset('css/estilos1.css') }}">
    <script src="/js/filtradoEventos.js"></script>
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
                    <p>Artista ID: {{ $noticia->id_artista }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@include('pie')
</body>
</html>

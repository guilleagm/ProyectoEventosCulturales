<link rel="stylesheet" href="/css/estilos1.css">
<div class="container">
    <h1>Lista de Noticias</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Texto</th>
            <th>Artista ID</th>
            <th>Usuario ID</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($noticias as $noticia)
            <tr>
                <td>{{ $noticia->id }}</td>
                <td>
                    <a href="{{ route('noticias.show', $noticia->id) }}">
                        {{ $noticia->titulo }}
                    </a>
                </td>
                <td>{{ $noticia->texto }}</td>
                <td>{{ $noticia->id_artista }}</td>
                <td>{{ $noticia->id_usuario }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

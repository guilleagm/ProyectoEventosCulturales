<div class="container">
    <h1>Resultados de la Búsqueda para "{{ $busqueda }}"</h1>
    @if ($eventos->isEmpty())
        <p>No se encontraron eventos para el usuario "{{ $busqueda }}".</p>
    @else
        <ul>
            @foreach ($eventos as $evento)
                <li>
                    <a href="{{ route('eventos.ver', $evento->id) }}">{{ $evento->titulo }}</a>
                    - {{ $evento->fecha }}
                </li>
            @endforeach
        </ul>
    @endif
</div>

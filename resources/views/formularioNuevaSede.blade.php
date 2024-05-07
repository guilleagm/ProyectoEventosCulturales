<link rel="stylesheet" href="/css/estilos1.css">
@auth
    @if (Auth::user()->esAdmin)
<div class="container">
    <h1>Crear Nueva Sede</h1>
    <form method="POST" action="{{ route('sedes.store') }}">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="dirección">Dirección:</label>
        <input type="text" name="dirección" required><br>

        <label for="capacidad">Capacidad:</label>
        <input type="number" name="capacidad" required><br>

        <label for="accesibilidad">Accesibilidad:</label>
        <select name="accesibilidad">
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select><br>

        <button type="submit">Crear Sede</button>
    </form>
</div>
    @endif
@endauth

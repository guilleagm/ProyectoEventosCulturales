@if (Auth::user()->esAdmin)
    <section>
        <nav>
            <a href="{{ route('formNuevaSede') }}">Crear Nueva Sede</a><br>
            <a href="{{ route('formNuevaNoticia') }}">Generar Noticia</a><br>
            <a href="{{ route('admin.users.index') }}">Lista usuarios</a><br>
            <a href="{{ route('sedes.listaSedes') }}">Ver sedes</a><br>
        </nav>
    </section>
@endif

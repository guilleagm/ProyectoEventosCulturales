<div class="container">
    <h2>Editar Perfil</h2>
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre_usuario">Nombre de Usuario:</label>
            <input type="text" name="nombre_usuario" class="form-control" value="{{ $user->nombre_usuario }}" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" name="correo" class="form-control" value="{{ $user->correo }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
    </form>
</div>

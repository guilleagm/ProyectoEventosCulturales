<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/estilosRegister.css') }}">
</head>
<body>
<div class="register-wrapper">
    <div class="branding-section">
    </div>

    <div class="form-section">
        <h1>Registro</h1>
        <form method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre_usuario">Nombre de usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="input-field" placeholder="Introduce un nombre de usuario" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" name="correo" id="correo" class="input-field" placeholder="Introduce un correo" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña" class="input-field" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen de perfil</label>
                <input type="file" name="imagen" id="imagen" accept="image/*" class="input-file">
            </div>
            <button type="submit" class="register-button">Registrar</button>
        </form>
    </div>
</div>
</body>
</html>

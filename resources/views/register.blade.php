<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<h1>Registro</h1>
<form method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data">
    @csrf
    <label for="nombre_usuario">Nombre de usuario:</label>
    <input type="text" name="nombre_usuario" id="nombre_usuario" required>
    <br>
    <label for="correo">Correo:</label>
    <input type="email" name="correo" id="correo" required>
    <br>
    <label for="contraseña">Contraseña:</label>
    <input type="password" name="contraseña" id="contraseña" required>
    <br>
    <label for="imagen">Imagen de perfil:</label>
    <input type="file" name="imagen" id="imagen" accept="image/*">
    <br>
    <button type="submit">Registrar</button>
</form>
</body>
</html>

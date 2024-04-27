<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
<form method="POST" action="{{ route('login.submit') }}">
    @csrf
    <label for="correo">Correo:</label>
    <input type="email" name="correo" required>
    <br>
    <label for="contraseña">Contraseña:</label>
    <input type="password" name="contraseña" required>
    <br>
    <button type="submit">Login</button>
</form>
</body>
</html>

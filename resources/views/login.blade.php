<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/estilosLogin.css') }}">
</head>
<body>
<div class="login-wrapper">
    <div class="branding-section">
    </div>

    <div class="form-section">
        <h1>Iniciar Sesión</h1>
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" id="email" name="correo" class="input-field" placeholder="Introduce tu correo electrónico" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="contraseña" class="input-field" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="login-button">Iniciar sesión</button>
            <div>
                <br>
                ¿No tienes cuenta aún?
                <a href="{{ route('register') }}">Regístrate</a>
            </div>
            <div>
                Iniciar sesión con Google
            </div>
        </form>
    </div>
</div>
</body>
</html>

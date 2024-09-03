<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <form id="loginForm">
            <div class="input-container">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" placeholder="Ingrese su usuario" required>
            </div>
            <div class="input-container">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>
            </div>
            <div class="button-container">
                <button id="btnLogin">Iniciar sesión</button>
            </div>
        </form>
        <div id="loginError" class="error-message"></div>
    </div>

    <script src="assets/js/login.js"></script>
    <script src="assets/js/login_service.js"></script>
</body>
</html>

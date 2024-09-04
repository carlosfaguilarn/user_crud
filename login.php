<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="container-logotipo">
            <img id="logo" src="./assets/img/logotipo_dark.png" class="logotipo" alt="logo" />
        </div>

        <h2>Iniciar sesión</h2>
        <h5 style="text-align: center;">Ingresa tus datos a continuación</h5>
        <form id="loginForm">
            <div class="input-container">
                <label for="username">Correo Electrónico:</label>
                <input type="text" id="username" name="username" placeholder="Ingrese el Correo" required>
            </div>
            <div class="input-container">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Introduzca Contraseña" required>
            </div>
            <div id="loginError" class="error-message"></div>

            <div class="button-container">
                <button id="btnLogin">Iniciar sesión</button>
            </div>
        </form>
    </div>

    <script src="assets/js/login.js"></script>
    <script src="assets/js/login_service.js"></script>
</body>

</html>
<?php
    // session_start();

    // if (!isset($_SESSION['user_id'])) {
    //     header("Location: login.php");
    //     exit;
    // }

    $title = "";
    $id = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $title = $id == -1 ? "Agregar usuario" : "Modificar usuario";
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/edit.css">
    <script src="assets/lib/jquery/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div id="left-panel" class="left-panel">
        <div class="panel-logo">
            <img id="logo" src="./assets/img/avion.png" class="logo-img" alt="logo" />
        </div>
        <div class="social-media-icons">
            <img src="./assets/img/red1.png" class="logo-img red" alt="red1" />
            <img src="./assets/img/red2.png" class="logo-img red" alt="red2" />
            <img src="./assets/img/red3.png" class="logo-img red" alt="red3" />
        </div>
    </div>
    <div class="container">
        <div class="form-container">
            <h2><?php echo $title ?></h2>
            <form id="userForm" method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

                <div class="input-container-form">
                    <div class="input-container">
                        <label for="email">Nombre</label>
                        <div class="input-wrapper">
                            <span class="icon">
                                <img src="./assets/img/user.png" alt="Email Icon">
                            </span>
                            <input type="text" id="name" name="name" placeholder="Nombre" required>
                        </div>
                        <div class="error-message" id="nameError"></div>
                    </div>

                    <div class="input-container">
                        <label for="email">Usuario</label>
                        <div class="input-wrapper">
                            <span class="icon">
                                <img src="./assets/img/user.png" alt="Usuario Icon">
                            </span>
                            <input type="text" id="username" name="username" placeholder="Usuario" required>
                        </div>
                        <div class="error-message" id="userError"></div>
                    </div>
    
                    <div class="input-container">
                        <label for="email">Correo electrónico</label>
                        <div class="input-wrapper">
                            <span class="icon">
                                <img src="./assets/img/email.png" alt="Correo Icon">
                            </span>
                            <input type="text" id="email" name="email" placeholder="Correo electrónico" required>
                        </div>
                        <div class="error-message" id="emailError"></div>
                    </div>
    
                    <div class="input-container">
                        <label for="email">Contraseña</label>
                        <div class="input-wrapper">
                            <span class="icon">
                                <img src="./assets/img/password.png" alt="Contraseña Icon">
                            </span>
                            <input type="password" id="password" name="password" placeholder="Contraseña" required>
                        </div>
                        <div class="error-message" id="passwordError"></div>
                    </div> 

                    <div class="input-container">
                        <label for="email">Confirmar contraseña</label>
                        <div class="input-wrapper">
                            <span class="icon">
                                <img src="./assets/img/password-confirm.png" alt="Confirmar contraseña Icon">
                            </span>
                            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmar contraseña" required>
                        </div>
                        <div class="error-message" id="passwordConfirmError"></div>
                    </div>  
                </div>
                

                <div class="button-container">
                    <button id="btnSave" class="btn-save">Guardar</button>
                    <button id="btnCancel" class="btn-cancel">Cancelar</button>
                </div>
            </form>
        </div>
        <div class="image-container">
            <img src="assets/img/office.png" alt="Imagen de fondo">
        </div>
    </div>

    <!-- Modal -->
    <div id="loadingModal" class="modal">
        <div class="modal-content">
            <div id="loader" class="loader"></div>
            <video id="successAnimation" style="display: none; width: 120px; margin: auto;" width="100%" autoplay loop muted>
                <source src="assets/img/success.webm" type="video/webm">
                Your browser does not support the video tag.
            </video>
            <video id="errorAnimation" style="display: none; width: 120px; margin: auto;" width="100%" autoplay loop muted>
                <source src="assets/img/error.webm" type="video/webm">
                Your browser does not support the video tag.
            </video>
            <p id="modalText">Cargando...</p>
        </div>
    </div>

    <script src="assets/js/edit_user.js"></script>
    <script src="assets/js/user_service.js"></script>
</body>

</html>
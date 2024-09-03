<?php
    $title = "";
    $id = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $title = $id == -1 ? "Agregar usuario" : "Modificar usuario";
        //$title = $id;
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modificar Registro</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/edit.css">
    <script src="assets/lib/jquery/jquery-3.7.1.min.js"></script>
    <!-- <link  href="assets/lib/fontawesome-6.6.0/css/fontawesome.css" rel="stylesheet" />
    <link  href="assets/lib/fontawesome-6.6.0/css/brands.css" rel="stylesheet" />
    <link  href="assets/lib/fontawesome-6.6.0/css/solid.css" rel="stylesheet" />  -->
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2><?php echo $title ?></h2>
            <form id="userForm" method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                <div class="input-container">
                    <label for="username">Nombre de usuario:</label>
                    <i class="fa fa-user"></i>
                    <input type="text" id="name" name="name" placeholder="Nombre" required>
                </div>

                <div class="input-container">
                    <label for="username">Usuario:</label>
                    <i class="fa fa-user"></i>
                    <input type="text" id="username" name="username" placeholder="Usuario" required>
                </div>

                <div class="input-container">
                    <label for="username">Correo electrónico:</label>
                    <i class="fa fa-user"></i>
                    <input type="text" id="email" name="email" placeholder="Correo electrónico" required>
                </div>

                <div class="input-container">
                    <label for="username">Contraseña:</label>
                    <i class="fa fa-user"></i>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                </div>

                <div class="input-container">
                    <label for="username">Confirmar contraseña:</label>
                    <i class="fa fa-user"></i>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmar contraseña" required>
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

    <script src="assets/js/edit_user.js"></script>
    <script src="assets/js/user_service.js"></script>
</body>

</html>
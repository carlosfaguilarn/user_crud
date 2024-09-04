<?php
session_start();

// Verifica si el usuario ha iniciado sesión
$isLoggedIn = isset($_SESSION['user_id']);

if (isset($_GET['mod']) && $_GET['mod'] === 'lg') {
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_unset();
        session_destroy();
    }
    $isLoggedIn = false;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/lib/jquery/jquery-3.7.1.min.js"></script>
</head>

<body>
    <input type="hidden" id="isLoggedIn" name="isLoggedIn" value="<?php echo $isLoggedIn; ?>">
    <div class="container">
        <header class="header">
            <div class="container-button-add">
                <button id="addUserBtn" class="add-contact">Agregar usuario</button>
            </div>
            <div class="logo">
                <img src="./assets/img/logotipo.png" class="logotipo" alt="logotipo" />
            </div>
        </header>

        <div class="main">
            <aside class="sidebar">
                <ul class="menu">
                    <li class="menu-item">Trabajo</li>
                    <li class="menu-item">Diseño</li>
                    <li class="menu-item">Familia</li>
                    <li class="menu-item">Amigos</li>
                    <li class="menu-item">Oficina</li>
                </ul>

                <?php if ($isLoggedIn): ?>
                    <button id="btnLogin" data-id="logout" class="btn-session btn-logout">Cerrar sesión</button>
                <?php else: ?>
                    <button id="btnLogin" data-id="login" class="btn-session btn-login">Iniciar sesión</button>
                <?php endif; ?>
            </aside>

            <section class="content">
                <table id="userTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Fecha registro</th>
                            <th>Última modificación</th>
                            <?php if ($isLoggedIn): ?> <th>Acciones</th> <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                    </tbody>
                </table>
            </section>
        </div>
    </div>

    <form id="frmUsers" method="post" action="edit.php">
        <input type="hidden" id="hdnUserId" name="id" />
    </form>

    <!-- Modal de Confirmación -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content"> 
            <p id="messageConfirmation"></p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="confirm-btn">Eliminar</button>
                <button id="cancelDelete" class="cancel-btn">Cancelar</button>
            </div>
        </div>
    </div>

    <script src="assets/js/user.js"></script>
    <script src="assets/js/user_service.js"></script>
</body>

</html>
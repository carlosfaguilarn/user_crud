<?php
    session_start();

    // Verifica si el usuario ha iniciado sesión
    $isLoggedIn = isset($_SESSION['user_id']); 

    if (isset($_GET['mod']) && $_GET['mod'] === 'lg') {
        // Asegurarse de que la sesión está activa antes de destruirla
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();  // Elimina todas las variables de sesión
            session_destroy(); // Destruye la sesión
        }
        $isLoggedIn = false;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>
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
                    <li class="menu-item">Trabajo <span class="count">12</span></li>
                    <li class="menu-item">Diseño <span class="count">30</span></li>
                    <li class="menu-item">Familia <span class="count">5</span></li>
                    <li class="menu-item">Amigos <span class="count">10</span></li>
                    <li class="menu-item">Oficina <span class="count">3</span></li>
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

    <script src="assets/js/user.js"></script>
    <script src="assets/js/user_service.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/lib/jquery/jquery-3.7.1.min.js"></script>
</head>
<!-- <body>
    <div class="container">
        <h1>Gestión de Usuarios</h1>
        <button class="add" id="addUserBtn">Agregar usuario</button>
        <table id="userTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Fecha registro</th>
                    <th>Última modificación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
            </tbody>
        </table>
    </div>

    <form id="frmUsers" method="post" action="edit.php">
        <input type="hidden" id="hdnUserId" name="id" />
    </form>

    <script src="assets/js/user.js"></script>
    <script src="assets/js/user_service.js"></script>
</body> -->
<body>
    <div class="container">
        <header class="header">
            <!-- <div class="header-left">
                <span>Mostrar</span>
                <select id="entries">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span>entradas</span>
            </div> -->
            <div class="container-button-add">
                <button id="addUserBtn" class="add-contact">Agregar usuario</button>
            </div>

            <div class="logo">
                <img src="./assets/img/logotipo.png" class="logotipo" alt="logotipo" />
            </div>
            <!-- <div class="header-right">
                <input type="text" placeholder="Buscador..." id="search">
            </div> -->
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
                <button id="btnLogin" class="btn-login">Iniciar sesión</button>
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
                            <th>Acciones</th>
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
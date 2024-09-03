<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/lib/jquery/jquery-3.7.1.min.js"></script>
    <link  href="assets/lib/fontawesome-6.6.0/css/fontawesome.css" rel="stylesheet" />
    <link  href="assets/lib/fontawesome-6.6.0/css/brands.css" rel="stylesheet" />
    <link  href="assets/lib/fontawesome-6.6.0/css/solid.css" rel="stylesheet" /> 
    <!-- <link rel="stylesheet" href="assets/css/edit.css"> -->
    <!-- Puedes agregar una librería de íconos como FontAwesome si lo prefieres -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
</head>
<body>
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
                <!-- Aquí se cargarán los usuarios mediante Ajax -->
            </tbody>
        </table>
    </div>

    <form id="frmUsers" method="post" action="edit.php">
        <input type="hidden" id="hdnUserId" name="id" />
    </form>

    <!-- Incluye el archivo JavaScript -->
    <script src="assets/js/user.js"></script>
    <script src="assets/js/user_service.js"></script>
</body>
</html>
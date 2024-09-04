User_Service = {
    module_prefix: "actions/user",

    // Método para obtener todos los usuarios
    GetUsers: function (successCallBack) {
        $.ajax({
            url: User_Service.module_prefix + '/obtener_usuarios.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                successCallBack(data);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    },

    // Método para obtener un usuario
    GetUser: function (userId, successCallBack) {
        $.ajax({
            url: User_Service.module_prefix + '/obtener_usuarios.php',
            type: 'GET',
            data: { id: encodeURIComponent(userId) },
            dataType: 'json',
            success: function(data) {
                successCallBack(data);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    },

    // Método para guardar un usuario
    SaveUser: function (formData, successCallBack) {
        $.ajax({
            url: User_Service.module_prefix + '/agregar_usuario.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                successCallBack(response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    },

    // Método para actualizar un usuario
    UpdateUser: function (formData, successCallBack) {
        $.ajax({
            url: User_Service.module_prefix + '/editar_usuario.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                successCallBack(response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    },

    // Método para eliminar un usuario
    DeleteUser: function (formData, successCallBack) {
        $.ajax({
            url: User_Service.module_prefix + '/eliminar_usuario.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                successCallBack(response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
};
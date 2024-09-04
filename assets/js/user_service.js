User_Service = {
    module_prefix: "actions/user",

    // Método para obtener todos los usuarios
    GetUsers: function (successCallBack) {
        $.ajax({
            url: User_Service.module_prefix + '/obtener_usuarios.php',
            type: 'GET',
            dataType: 'json',               
            complete: function(xhr, status) {
                var response = xhr.responseJSON;
                successCallBack(response);
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
            complete: function(xhr, status) {
                var response = xhr.responseJSON;
                successCallBack(response);
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
            complete: function(xhr, status) {
                var response = xhr.responseJSON;
                successCallBack(response);
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
            complete: function(xhr, status) {
                var response = xhr.responseJSON;
                successCallBack(response);
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
            complete: function(xhr, status) {
                var response = xhr.responseJSON;
                successCallBack(response);
            }
        });
    }
};
User_Service = {

    module_prefix: "actions/user",

    GetUsers: function (successCallBack) {
        fetch(User_Service.module_prefix+'/obtener_usuarios.php')
            .then(response => response.json())
            .then(data => successCallBack(data))
            .catch(error => console.error('Error:', error));
    },

    GetUser: function (userId, successCallBack) {
        fetch(User_Service.module_prefix+'/obtener_usuarios.php?id=' + encodeURIComponent(userId))
            .then(response => response.json())
            .then(data => successCallBack(data))
            .catch(error => console.error('Error:', error));
    },

    SaveUser: function (formData, successCallBack) { 
        fetch(User_Service.module_prefix+'/agregar_usuario.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then((response) => successCallBack(response))
        .catch(error => console.error('Error:', error));
    },

    UpdateUser: function (formData, successCallBack) { 
        fetch(User_Service.module_prefix+'/editar_usuario.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then((response) => successCallBack(response))
        .catch(error => console.error('Error:', error));
    },

    DeleteUser: function (formData, successCallBack) {
        fetch(User_Service.module_prefix+'/eliminar_usuario.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then((response) => successCallBack(response))
        .catch(error => console.error('Error:', error));
    }
};

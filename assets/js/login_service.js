Login_Service = {
    module_prefix: "actions/user",

    // Método para validar inicio de sesión en el servicio
    Login: function (formData, successCallBack) { 
        $.ajax({
            url: Login_Service.module_prefix + '/iniciar_sesion.php',
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
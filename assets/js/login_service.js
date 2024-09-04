Login_Service = {
    module_prefix: "actions/user",

    // Método para validar inicio de sesión en el servicio
    Login: function (formData, successCallBack, errorCallback) { 
        $.ajax({
            url: Login_Service.module_prefix + '/iniciar_sesion.php',
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
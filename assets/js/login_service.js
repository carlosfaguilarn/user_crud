Login_Service = {
    module_prefix: "actions/user",

    Login: function (formData, successCallBack) { 
        debugger;
        console.log(formData);
        fetch(Login_Service.module_prefix+'/iniciar_sesion.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then((response) => successCallBack(response))
        .catch(error => console.error('Error:', error));
    },
};

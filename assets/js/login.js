var Login = {
    // Definición de los selectores de control utilizados en el DOM
    Controls: {
        BtnLogin: "#btnLogin",
        Username: "#username",
        Password: "#password",
        LoginForm: "#loginForm"
    },

    // Inicializa la aplicación
    Init: function () {
        this.BindEvents();
    },

    // Asocia eventos a los elementos del DOM
    BindEvents: function () {
        var self = this; 
        document.querySelector(this.Controls.BtnLogin).addEventListener('click', function () {
            event.preventDefault();
            Login.AttemptLogin();
        });  
    }, 

    // Limpia los errores del formulario
    ClearForm: function () { 
        document.querySelectorAll('.error-message').forEach(function(el) {
            el.textContent = '';
        });
    },

    // Procesa la solicitud de inicio de sesión y las validaciones
    AttemptLogin: function () {
        Login.ClearForm();
        var form = document.querySelector(Login.Controls.LoginForm);
        var username = form.querySelector('#username').value.trim(); 
        var password = form.querySelector('#password').value.trim(); 

        var isFormValid = true;

        if(username === ''){
            document.getElementById('userError').textContent = 'El usuario es requerido';
            isFormValid = false;
        }
        
        if(password === ''){
            document.getElementById('passwordError').textContent = 'La contraseña es requerida';
            isFormValid = false;
        }

        if(!isFormValid) return;

        var jsonData = {
            "username": document.querySelector(this.Controls.Username).value,
            "password": document.querySelector(this.Controls.Password).value
        };
        var jsonString = JSON.stringify(jsonData);
        Login_Service.Login(jsonString, Login.LogginSuccess); 
    },

    // Procesa la respuesta de la llamada al servicio de inicio de sesión
    LogginSuccess: function (response){
        if (response.status) {
            window.location.href = 'index.php';
        } else {
            document.querySelector('#loginError').textContent = response.message;
        }
    }
};

// Ejecuta la inicialización del módulo Login cuando el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    Login.Init();
});
var Login = {
    Controls: {
        BtnLogin: "#btnLogin",
        Username: "#username",
        Password: "#password",
        LoginForm: "#loginForm"
    },

    Init: function () {
        this.BindEvents();
    },

    BindEvents: function () {
        var self = this; 
        document.querySelector(this.Controls.BtnLogin).addEventListener('click', function () {
            event.preventDefault();
            Login.AttemptLogin();
        });  
    }, 

    ClearForm: function () { 
        document.querySelectorAll('.error-message').forEach(function(el) {
            el.textContent = '';
        });
    },

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

    LogginSuccess: function (response){
        debugger;
        if (response.status) {
            window.location.href = 'index.php';
        } else {
            document.querySelector('#loginError').textContent = response.message;
        }
    }
};

document.addEventListener('DOMContentLoaded', function () {
    Login.Init();
});
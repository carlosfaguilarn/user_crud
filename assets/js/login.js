var Login = {
    Controls: {
        BtnLogin: "#btnLogin",
        Username: "#username",
        Password: "#password",
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

    AttemptLogin: function () {
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
            alert("Bienvenido");
            window.location.href = 'index.php';
        } else {
            document.querySelector('#loginError').textContent = response.message;
        }
    }
};

document.addEventListener('DOMContentLoaded', function () {
    Login.Init();
});
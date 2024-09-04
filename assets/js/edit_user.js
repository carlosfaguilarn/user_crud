var EditUser = {
    // Definición de los selectores de control utilizados en el DOM
    Controls: {
        UserTable: "#userTable",
        AddUserBtn: "#addUserBtn",
        UserModal: "#userModal",
        UserForm: "#userForm",
        SaveBtn: "#btnSave",
        CancelBtn: "#btnCancel",
        UserId: "#id",
        Logo: "#logo"
    },

    // Inicializa la aplicación
    Init: function () {
        EditUser.SearchUser(); 
        EditUser.BindEvents(); 
        EditUser.ClearForm();
    },

    // Asocia eventos a los elementos del DOM
    BindEvents: function () {
        var self = this;

        document.querySelector(this.Controls.SaveBtn).addEventListener('click', function () {
            event.preventDefault();
            EditUser.SaveUser();
        }); 
        
        document.querySelector(this.Controls.CancelBtn).addEventListener('click', function () {
            event.preventDefault();
            window.location.href = 'index.php';
        }); 
        
        document.querySelector(this.Controls.Logo).addEventListener('click', function () {
            event.preventDefault();
            window.location.href = 'index.php';
        }); 
    },

    // Limpia los errores del formulario
    ClearForm: function () { 
        document.querySelectorAll('.error-message').forEach(function(el) {
            el.textContent = '';
        });
    },

    // Busca el usuario indicado
    SearchUser: function () {
        var id = document.querySelector(this.Controls.UserId).value;

        if(id == -1){
            // Si no existe el parametro id, crea objeto para nuevo usuario
            var newUser = {
                id: -1,
                name: "",
                email: "",
                username: "",
                password: "",
            };
            EditUser.LoadUserSuccess(newUser);
        }else{
            // Usuario existente
            User_Service.GetUser(id, EditUser.LoadUserSuccess);
        }
    },

    // Carga la información del usuario en el formulario
    LoadUserSuccess: function (user) {
        var form = document.querySelector(EditUser.Controls.UserForm);
        form.querySelector('#name').value = user.name;
        form.querySelector('#email').value = user.email; 
        form.querySelector('#username').value = user.username; 
        form.querySelector('#password').value = user.password; 
        form.querySelector('#confirm-password').value = user.password; 
    },

    // Procesa la solicitud de guardar el usuario y las validaciones necesarias
    SaveUser: function () { 
        EditUser.ClearForm();
        var form = document.querySelector(EditUser.Controls.UserForm);
        var name = form.querySelector('#name').value.trim(); 
        var email = form.querySelector('#email').value.trim(); 
        var username = form.querySelector('#username').value.trim(); 
        var password = form.querySelector('#password').value.trim(); 
        var passwordConfirm = form.querySelector('#confirm-password').value.trim(); 

        isFormValid = true;

        if(name === ''){
            document.getElementById('nameError').textContent = 'El nombre es requerido';
            isFormValid = false;
        }

        if(email === ''){
            document.getElementById('emailError').textContent = 'El correo electrónico es requerido';
            isFormValid = false;
        }

        if(!EditUser.isValidEmail(email)){
            document.getElementById('emailError').textContent = 'Por favor, ingrese un correo electrónico válido';
            isFormValid = false;
        }

        if(username === ''){
            document.getElementById('userError').textContent = 'El usuario es requerido';
            isFormValid = false;
        }

        if(password === ''){
            document.getElementById('passwordError').textContent = 'La contraseña es requerido';
            isFormValid = false;
        }

        if(password != passwordConfirm){
            document.getElementById('passwordConfirmError').textContent = 'Las contraseñas no coinciden';
            isFormValid = false;
        }

        if(!isFormValid) return;

        // Mostrar el modal de carga
        EditUser.showLoadingModal();

        var formData = new FormData(document.querySelector(EditUser.Controls.UserForm));
        var jsonData = {};
        formData.forEach(function(value, key){
            jsonData[key] = value;
        });

        // Convertir el objeto plano a JSON
        var jsonString = JSON.stringify(jsonData);

        if(jsonData.id == -1){
            User_Service.SaveUser(jsonString, EditUser.SaveUserSuccess);
        }else{
            User_Service.UpdateUser(jsonString, EditUser.SaveUserSuccess);
        }
    },

    // Procesa la respuesta de la llamada al servicio para guardar usuario
    SaveUserSuccess: function (result) {
        setTimeout(function(){
            if(result.success){
                EditUser.updateModalText(true, "El usuario se guardó exitósamente");
                setTimeout(function (){
                    window.location.href = 'index.php'; 
                }, 2000);
            }else{
                EditUser.updateModalText(false, "Error: " + result.message);
                setTimeout(EditUser.hideLoadingModal, 2000);
            }
        }, 500); 
    },

    // Función para mostrar el modal
    showLoadingModal: function () {
        const modal = document.getElementById("loadingModal");
        modal.style.display = "flex";
    },

    // Función para ocultar el modal
    hideLoadingModal: function () {
        const modal = document.getElementById("loadingModal");
        modal.style.display = "none";
    },

    // Función para cambiar el contenido del modal
    updateModalText: function (status, text) {
        const modalText = document.getElementById("modalText");
        const loader = document.getElementById("loader");
        const successAnimation = document.getElementById("successAnimation");
        const errorAnimation = document.getElementById("errorAnimation");

        modalText.textContent = text;
        loader.style.display = 'none';
        
        if(status){
            successAnimation.style.display = 'flex';
            errorAnimation.style.display = 'none';
        }else{
            successAnimation.style.display = 'none';
            errorAnimation.style.display = 'flex';
        }
    },

    // Validar si el correo tiene una estructura correcta
    isValidEmail: function (email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
};

// Ejecuta la inicialización del módulo Login cuando el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    EditUser.Init();
});

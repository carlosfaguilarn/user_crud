var EditUser = {
    Controls: {
        UserTable: "#userTable",
        AddUserBtn: "#addUserBtn",
        UserModal: "#userModal",
        UserForm: "#userForm",
        SaveBtn: "#btnSave",
        CancelBtn: "#btnCancel",
        UserId: "#id"
    },

    Init: function () {
        EditUser.SearchUser(); 
        EditUser.BindEvents(); 
    },

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
    },

    ClearForm: function () {
        var form = document.querySelector(this.Controls.UserForm);
        form.reset();
        form.querySelector('input[name="id"]').value = '';
    },

    SearchUser: function () {
        var id = document.querySelector(this.Controls.UserId).value;

        if(id == -1){
            // Es nuevo usuario
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

    LoadUserSuccess: function (user) {
        var form = document.querySelector(EditUser.Controls.UserForm);
        form.querySelector('#name').value = user.name;
        form.querySelector('#email').value = user.email; 
        form.querySelector('#username').value = user.username; 
        form.querySelector('#password').value = user.password; 
        form.querySelector('#confirm-password').value = user.password; 
    },

    SaveUser: function () {
        debugger;
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

    SaveUserSuccess: function (result) {
        alert('Usuario guardado con éxito.');
        window.location.href = 'index.php'; 
    }
};

document.addEventListener('DOMContentLoaded', function () {
    EditUser.Init();
});

var UserManagement = {
    Controls: {
        UserTable: "#userTable",
        AddUserBtn: "#addUserBtn",
        UserModal: "#userModal",
        UserForm: "#userForm",
        SaveUserBtn: "#saveUserBtn",
        FrmUser: "#frmUsers",
        UserId: "#hdnUserId"
    },

    Init: function () {
        this.LoadUsers();
        this.BindEvents();
    },

    BindEvents: function () {
        var self = this;

        document.querySelector(this.Controls.AddUserBtn).addEventListener('click', function () {
            debugger;
            $('#hdnUserId').val(-1);
            $('#frmUsers').submit();
        }); 

        document.getElementById('userTableBody').addEventListener('click', function(event) {
            if (event.target.classList.contains('edit-user')) {
                var userId = event.target.getAttribute('data-id');
                $('#hdnUserId').val(userId);
                $('#frmUsers').submit(); 
            }
        });

        document.getElementById('userTableBody').addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-user')) {
                var userId = event.target.getAttribute('data-id');
                var res = confirm("Se eliminará el usuario: " + userId + " \n ¿Continuar?");
                if(res){
                    UserManagement.DeleteUser(userId);
                }
            }
        });
    },

    LoadUsers: function () {
        var self = this;
        User_Service.GetUsers(function (data) {
            var userTableBody = '';
            data.forEach(function (user) {
                userTableBody += '<tr>';
                userTableBody += '<td>' + user.id + '</td>';
                userTableBody += '<td>' + user.name + '</td>';
                userTableBody += '<td>' + user.username + '</td>';
                userTableBody += '<td>' + user.email + '</td>';
                userTableBody += '<td>' + user.created_at + '</td>';
                userTableBody += '<td>' + user.updated_at + '</td>';
                userTableBody += '<td>';
                userTableBody += '<img src="./assets/img/edit-icon.png" data-id="' + user.id + '" class="action-btn edit-user" alt="action" />';
                userTableBody += '<img src="./assets/img/del-icon.png" data-id="' + user.id + '" class="action-btn delete-user" alt="action" />';
                userTableBody += '</td>';
                userTableBody += '</tr>';
            });
            document.querySelector(self.Controls.UserTable + ' tbody').innerHTML = userTableBody;
        });
    },

    ClearForm: function () {
        var form = document.querySelector(this.Controls.UserForm);
        form.reset();
        form.querySelector('input[name="id"]').value = '';
    },
 

    DeleteUser: function (userId) {
        debugger; 

        var jsonString = JSON.stringify({
            id: userId
        });
 
        User_Service.DeleteUser(jsonString, function (response) {
            debugger; 
            if(response.success){
                alert('Usuario eliminado exitósamente');
                UserManagement.LoadUsers();
            }else{
                alert('Ocurrió un error al eliminar el usuario');
            }
        });
    }
};

document.addEventListener('DOMContentLoaded', function () {
    UserManagement.Init();
});
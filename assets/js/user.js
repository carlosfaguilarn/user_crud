var UserManagement = {
    IsLoggedIn: false,
    userIdToDelete: null,
    modalConfirmation: null,

    Controls: {
        UserTable: "#userTable",
        AddUserBtn: "#addUserBtn",
        UserModal: "#userModal",
        UserForm: "#userForm",
        SaveUserBtn: "#saveUserBtn",
        FrmUser: "#frmUsers",
        UserId: "#hdnUserId",
        BtnLogin: "#btnLogin", 
        IsLoggedIn: "#isLoggedIn",
        ConfirmDelete: "#confirmDelete",
        CancelDelete: "#cancelDelete"
    },

    Init: function () {
        UserManagement.IsLoggedIn = document.querySelector(this.Controls.IsLoggedIn).value;
        UserManagement.modalConfirmation = document.getElementById('confirmationModal');
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
                UserManagement.userIdToDelete = event.target.getAttribute('data-id');
                UserManagement.modalConfirmation.style.display = 'block';

                document.querySelector("#messageConfirmation").textContent = "¿Estás seguro de que deseas eliminar el usuario "+event.target.getAttribute('data-name')+"?";
            }
        });
  
        document.querySelector(this.Controls.BtnLogin).addEventListener('click', function () {
            event.preventDefault();
            if(UserManagement.IsLoggedIn){
                window.location.href = 'index.php?mod=lg';
            }else{
                window.location.href = 'login.php';
            }
        }); 

        document.querySelector(this.Controls.ConfirmDelete).addEventListener('click', function() {
            if (UserManagement.userIdToDelete) {
                UserManagement.DeleteUser(UserManagement.userIdToDelete);
                UserManagement.modalConfirmation.style.display = 'none';
            }
        });

        document.querySelector(this.Controls.CancelDelete).addEventListener('click', function() {
            UserManagement.modalConfirmation.style.display = 'none';
            UserManagement.userIdToDelete = null;
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
                userTableBody += '<td>' + UserManagement.FormatDate(user.created_at) + '</td>';
                userTableBody += '<td>' + UserManagement.FormatDate(user.updated_at) + '</td>';

                if(UserManagement.IsLoggedIn){
                    userTableBody += '<td>';
                    userTableBody += '<img src="./assets/img/edit-icon.png" data-id="' + user.id + '" class="action-btn edit-user" alt="action" />';
                    userTableBody += '<img src="./assets/img/del-icon.png" data-id="' + user.id + '" data-name="' + user.name + '" class="action-btn delete-user" alt="action" />';
                    userTableBody += '</td>';
                }
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
        var jsonString = JSON.stringify({
            id: userId
        });
 
        User_Service.DeleteUser(jsonString, function (response) {
            debugger; 
            if(response.success){
                UserManagement.LoadUsers();
            }else{
                alert('Ocurrió un error al eliminar el usuario');
            }
        });
    },

    FormatDate: function(dateString) {
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Los meses son 0-indexados
        const year = date.getFullYear();
        
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');
        const formattedDate = `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
    
        return formattedDate;
    }
};

document.addEventListener('DOMContentLoaded', function () {
    UserManagement.Init();
});
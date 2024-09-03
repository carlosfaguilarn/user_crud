User_Service = {

    module_prefix: "actions/user",

    GetUsers: function (successCallBack) {
        fetch(User_Service.module_prefix+'/get_users.php')
            .then(response => response.json())
            .then(data => successCallBack(data))
            .catch(error => console.error('Error:', error));
    },

    GetUser: function (userId, successCallBack) {
        fetch(User_Service.module_prefix+'/get_users.php?id=' + encodeURIComponent(userId))
            .then(response => response.json())
            .then(data => successCallBack(data))
            .catch(error => console.error('Error:', error));
    },

    SaveUser: function (formData, successCallBack) { 
        fetch(User_Service.module_prefix+'/create_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then((response) => successCallBack(response))
        .catch(error => console.error('Error:', error));
    },

    UpdateUser: function (formData, successCallBack) { 
        fetch(User_Service.module_prefix+'/update_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then((response) => successCallBack(response))
        .catch(error => console.error('Error:', error));
    },

    DeleteUser: function (formData, successCallBack) {
        fetch(User_Service.module_prefix+'/delete_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then((response) => successCallBack(response))
        .catch(error => console.error('Error:', error));
    }
};

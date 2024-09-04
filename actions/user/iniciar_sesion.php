<?php
    session_start();
    header("Content-Type: application/json");
    include_once '../../model/User.php';

    $user = new User();
    $data = json_decode(file_get_contents("php://input"));

    // Verifica que los campos requeridos no estén vacíos
    if (
        !empty($data->username)&&
        !empty($data->password)
    ) {
        $user->username = $data->username;
        $user->password = $data->password;

        // Verifica las credenciales del usuario
        $response_login = $user->login();

        // Si las credenciales son correctas, inicia la sesión
        if ($response_login['status'] === true) {
            $_SESSION['user_id'] = $user->username;
            $_SESSION['username'] = $user->username;
            http_response_code(200); 
        }else{
            http_response_code(400);
        }
        echo json_encode($response_login);
    } else {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Datos incompletos."]);
    }
?>


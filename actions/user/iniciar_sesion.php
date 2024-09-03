<?php
    header("Content-Type: application/json");
    include_once '../../model/User.php';

    $user = new User();
    $data = json_decode(file_get_contents("php://input"));

    if (
        !empty($data->username)&&
        !empty($data->password)
    ) {
        $user->username = $data->username;
        $user->password = $data->password;

        if ($user->login()) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Usuario o contraseña incorrectos']);
        }
    } else {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Datos incompletos."]);
    }
?>


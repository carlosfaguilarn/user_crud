<?php
    header("Content-Type: application/json");
    include_once '../../model/User.php';

    $user = new User();

    $data = json_decode(file_get_contents("php://input"));

    if (
        !empty($data->name) &&
        !empty($data->username)&&
        !empty($data->password)&&
        !empty($data->email)
    ) {
        $user->name = $data->name;
        $user->username = $data->username;
        $user->password = $data->password;
        $user->email = $data->email;
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');

        if ($user->create()) {
            http_response_code(201);
            echo json_encode(["success" => true, "message" => "Usuario creado exitosamente."]);
        } else {
            http_response_code(503);
            echo json_encode(["success" => false, "message" => "No se pudo crear el usuario."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Datos incompletos."]);
    }
?>

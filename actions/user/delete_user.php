<?php
    header("Content-Type: application/json");

    include_once '../../model/User.php';
    $user = new User();
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id)) {
        $user->id = $data->id;

        if ($user->delete()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Usuario eliminado exitosamente."]);
        } else {
            http_response_code(503);
            echo json_encode(["success" => false, "message" => "No se pudo eliminar el usuario."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "ID del usuario faltante."]);
    }
?>

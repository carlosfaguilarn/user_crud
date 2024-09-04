<?php
    header("Content-Type: application/json");

    include_once '../../model/User.php';
    $user = new User();
    $data = json_decode(file_get_contents("php://input"));

    // Verifica que los campos requeridos no estén vacíos
    if (!empty($data->id)) {
        $user->id = $data->id;

        // Intenta eliminar el usuario de la base de datos
        if ($user->delete()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Usuario eliminado exitosamente."]);
        } else {
            // Si no se puede eliminar el usuario, devuelve un código de respuesta 503 (Servicio no disponible)
            http_response_code(503);
            echo json_encode(["success" => false, "message" => "No se pudo eliminar el usuario."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "ID del usuario faltante."]);
    }
?>

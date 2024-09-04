<?php
    header("Content-Type: application/json");
    include_once '../../model/User.php';
    $user = new User();
    $data = json_decode(file_get_contents("php://input"));

    // Verifica que los campos requeridos no estén vacíos
    if (
        !empty($data->id) &&
        !empty($data->name) &&
        !empty($data->username)&&
        //!empty($data->password)&&
        !empty($data->email)
    ) {
        // Asigna los valores del objeto $data a las propiedades del objeto $user
        $user->id = $data->id;
        $user->name = $data->name;
        $user->username = $data->username;
        //$user->password = $data->password;
        $user->email = $data->email;
        $user->updated_at = date('Y-m-d H:i:s');

        // Intenta editar el usuario en la base de datos
        if ($user->update()) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => "Usuario actualizado exitosamente."]);
        } else {
            // Si no se puede editar el usuario, devuelve un código de respuesta 503 (Servicio no disponible)
            http_response_code(503);
            echo json_encode(["success" => false, "message" => "No se pudo actualizar el usuario."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Datos incompletos."]);
    }
?>

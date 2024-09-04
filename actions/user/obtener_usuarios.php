<?php
    header("Content-Type: application/json");
    include_once '../../model/User.php';
    $user = new User();
    $response = [];

    // Verifica la existencia del parámetro id 
    if(isset($_GET['id'])){ 
        $id = $_GET['id'];
        
        // Obtiene el usuario indicado
        $stmt = $user->find($id);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $num = $stmt->rowCount();

        // Si no se encontró el usuario, devuelve error y termina el flujo
        if($num == 0){
            http_response_code(404);
            echo json_encode("No se encontró el usuario indicado");
            return;
        }

        // Prepara y devuelve los datos del usuario. Termina el flujo
        $user_item = [
            "id" => $row['id'],
            "name" => $row['name'],
            "username" => $row['username'],
            "email" => $row['email'],
            "created_at" => $row['created_at'],
            "updated_at" => $row['updated_at']
        ];

        $response = $user_item;
        http_response_code(200);
        echo json_encode($response);

        return;
    }
    
    // Si no existe el parametro id, devuelve todos los usuarios
    $stmt = $user->read();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $user_item = [
            "id" => $row['id'],
            "name" => $row['name'],
            "username" => $row['username'],
            "email" => $row['email'],
            "created_at" => $row['created_at'],
            "updated_at" => $row['updated_at']
        ];

        array_push($response, $user_item);
    } 

    http_response_code(200);
    echo json_encode($response);
?>

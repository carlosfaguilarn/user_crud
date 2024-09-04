<?php
// classes/User.php

include_once 'Database.php';

class User {
    private $conn;
    private $table_name = 'user';

    public $id;
    public $name;
    public $email;
    public $username;
    public $password;
    public $created_at;
    public $updated_at;

    public $database;

    public function __construct() {
        $this->database = new Database();
        $this->conn = $this->database->getConnection();
    }

    public function find($id) {
        $query = "SELECT id, name, username, email, created_at, updated_at FROM " . $this->table_name . " WHERE ID = '". $id ."'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read() {
        $query = "SELECT id, name, username, email, created_at, updated_at FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, username=:username, password=:password, email=:email, created_at=:created_at, updated_at=:updated_at";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));

        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":updated_at", $this->updated_at);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name,  username=:username, password=:password, email = :email, updated_at = :updated_at WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":updated_at", $this->updated_at);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function login() {
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // Procesar intentos de login
        $maxAttempts = 3;
        $mins = 1;
        $blockTime = $mins * 60; // Bloqueo temporal en segundos

        // Verificar si el usuario está bloqueado
        $query = "SELECT * FROM login_attempt WHERE username = ? AND attempt_time > NOW() - INTERVAL ? SECOND";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->username, $blockTime]);
        $failedAttempts = $stmt->rowCount();

        if ($failedAttempts >= $maxAttempts) {
            $response = [
                'status' => false,
                'message' => 'Tu cuenta está bloqueada temporalmente debido a múltiples intentos fallidos. Por favor, intenta de nuevo más tarde: '.$mins.' minuto(s).'
            ]; 

            return $response;
        }

        // Revisar credenciales
        $query = "SELECT id, username, password FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $this->username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['password'])) {
            $response = [
                'status' => true
            ]; 

            return $response;
        }

        // Intento fallido, registrar intento
        $query = "INSERT INTO login_attempt (username) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->username]);
        
        $response = [
            'status' => false,
            'message' => 'Usuario o contraseña incorrectos.'
        ]; 

        return $response;
    } 

}
?>

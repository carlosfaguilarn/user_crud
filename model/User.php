<?php
include_once 'Database.php';

class User
{
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

    public function __construct()
    {
        $this->database = new Database();
        $this->conn = $this->database->getConnection();
    }

    /**
     * Método para encontrar un usuario por su id
     * $id: id del usuario
     */
    public function find($id)
    {
        $query = "SELECT id, name, username, email, created_at, updated_at FROM " . $this->table_name . " WHERE ID = '" . $id . "'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Método para leer los registros de la tabla user
     */
    public function read()
    {
        $query = "SELECT id, name, username, email, created_at, updated_at FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Método para crear un nuevo usuario
     */
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, username=:username, password=:password, email=:email, created_at=:created_at, updated_at=:updated_at";

        $stmt = $this->conn->prepare($query);

        // Sanitizar y enlazar los datos del usuario
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));

         // Hashear la contraseña antes de almacenarla
         $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":updated_at", $this->updated_at);

        // Ejecutar la consulta y devolver true si es exitosa, de lo contrario false
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Método para actualizar un registro de la tabla usuario
     */
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET name = :name,  username=:username, email = :email, updated_at = :updated_at WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sanitizar y enlazar los datos del usuario
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->username = htmlspecialchars(strip_tags($this->username));
        //$this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
        $this->id = htmlspecialchars(strip_tags($this->id));

         // Hashear la contraseña antes de almacenarla
        //$hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":username", $this->username);
        //$stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":updated_at", $this->updated_at);
        $stmt->bindParam(":id", $this->id);

        // Ejecutar la consulta y devolver true si es exitosa, de lo contrario false
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Método para eliminar un usuario existente
     */
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        // Sanitizar y enlazar el ID del usuario
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);

        // Ejecutar la consulta y devolver true si es exitosa, de lo contrario false
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Método para 
     */
    public function login()
    {
        // Sanitizar el nombre de usuario y la contraseña
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // Configuración de los parámetros para el manejo de intentos fallidos
        $maxAttempts = 3;
        $mins = 1;
        $blockTime = $mins * 60;

        // Consulta SQL para verificar el número de intentos fallidos recientes
        $query = "SELECT * FROM login_attempt WHERE username = ? AND attempt_time > NOW() - INTERVAL ? SECOND";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->username, $blockTime]);
        $failedAttempts = $stmt->rowCount();

        // Si se superó el número máximo de intentos fallidos, devolver un mensaje de bloqueo
        if ($failedAttempts >= $maxAttempts) {
            $response = [
                'status' => false,
                'message' => 'Tu cuenta está bloqueada temporalmente debido a múltiples intentos fallidos. Por favor, intenta de nuevo más tarde: ' . $mins . ' minuto(s).'
            ];

            return $response;
        }

        // Consulta SQL para verificar las credenciales del usuario
        $query = "SELECT id, username, password FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $this->username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si la contraseña es correcta
        if ($user && password_verify($this->password, $user['password'])) {
            $response = [
                'status' => true
            ];

            return $response;
        }

        // Registrar un intento fallido de inicio de sesión
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

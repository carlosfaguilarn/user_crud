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

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
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

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
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
}
?>

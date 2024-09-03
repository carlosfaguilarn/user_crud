<?php
// classes/Database.php

class Database {
    private $conn;
    private $config;

    public function __construct() {
        $configPath = __DIR__ . '/../config/db.json';
        $this->config = json_decode(file_get_contents($configPath), true);
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->config['database']['host'] . 
                ";dbname=" . $this->config['database']['db_name'], 
                $this->config['database']['username'], 
                $this->config['database']['password']
            );
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>

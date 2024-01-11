<?php

namespace App\Core;
use PDO;
use PDOException;

class Database
{


    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "php2";
    private $charset = "utf8";

    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset={$this->charset}";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối database thất bại: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

}
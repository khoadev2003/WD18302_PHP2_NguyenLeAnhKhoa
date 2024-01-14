<?php

namespace App\Core;

use Dotenv\Dotenv as Dotenv;
use PDO;
use PDOException;


class Database
{


    private $_host;
    private $_username;
    private $_password;
    private $_database;
    private $_charset;

    private $pdo;

    public function __construct() {
        $dotenv = Dotenv::createImmutable(__DIR__. '/../../');
        $dotenv->load();

        $this->_host = $_ENV['DB_HOST'];
        $this->_username = $_ENV['DB_USERNAME'];
        $this->_password = $_ENV['DB_PASSWORD'];
        $this->_database = $_ENV['DB_DATABASE'];
        $this->_charset = $_ENV['DB_CHARSER'];

        try {
            $dsn = "mysql:host={$this->_host};dbname={$this->_database};charset={$this->_charset}";
            $this->pdo = new PDO($dsn, $this->_username, $this->_password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            die("Kết nối database thất bại: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

}
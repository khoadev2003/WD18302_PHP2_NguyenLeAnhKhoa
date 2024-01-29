<?php

namespace App\Core;

use PDO;
use PDOException;
use Dotenv\Dotenv as Dotenv;

class Database
{
    private $_host;
    private $_username;
    private $_password;
    private $_database;
    private $_charset;

    private $_conn;

    function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__. '/../../');
        $dotenv->load();

        $this->_host = $_ENV['DB_HOST'];
        $this->_username = $_ENV['DB_USERNAME'];
        $this->_password = $_ENV['DB_PASSWORD'];
        $this->_database = $_ENV['DB_DATABASE'];
        $this->_charset = $_ENV['DB_CHARSER'];

        try {
            $dsn = "mysql:host={$this->_host};dbname={$this->_database};charset={$this->_charset}";
            $this->_conn = new PDO($dsn, $this->_username, $this->_password);
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối database thất bại a a: " . $e->getMessage());
        }
    }

//    public function getConnection()
//    {
//        return $this->_conn;
//    }

    public function select($query, $params = [])
    {
        $stmt = $this->_conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($query, $params = [])
    {
        $stmt = $this->_conn->prepare($query);
        $stmt->execute($params);
        return $this->_conn->lastInsertId();
    }

    public function update($query, $params = [])
    {
        $stmt = $this->_conn->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($query, $params = [])
    {
        $stmt = $this->_conn->prepare($query);
        return $stmt->execute($params);
    }
}

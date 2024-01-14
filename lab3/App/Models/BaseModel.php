<?php

namespace App\Models;

use App\Abstract\ModelAbstract;
use Dotenv\Dotenv as Dotenv;
use PDO;
use PDOException;

class BaseModel extends ModelAbstract
{
    private $_host;
    private $_username;
    private $_password;
    private $_database;
    private $_charset;

    private $pdo;

    public function __construct() {

        // Load file .env
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


    public function select($sql){
        $sql_args = array_slice(func_get_args(), 1);
        try{
            $conn = $this->getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $rows = $stmt->fetchAll();
            return $rows;
        }
        catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }


    public function insert($table, $data) {
        try {
            $fields = implode(', ', array_keys($data));
            $values = implode(', ', array_fill(0, count($data), '?'));

            $sql = "INSERT INTO $table ($fields) VALUES ($values)";
            $this->execute($sql, ...array_values($data));
        } catch (PDOException $e) {
            // Handle or log the exception
            throw $e;
        }
    }

    public function update($table, $data, $condition) {
        try {
            $setClause = implode(', ', array_map(fn($key) => "$key = ?", array_keys($data)));

            $sql = "UPDATE $table SET $setClause WHERE $condition";
            $this->execute($sql, ...array_values($data));
        } catch (PDOException $e) {
            // Handle or log the exception
            throw $e;
        }
    }

    public function delete($table, $condition) {
        try {
            $sql = "DELETE FROM $table WHERE $condition";
            $this->execute($sql);
        } catch (PDOException $e) {
            
            throw $e;
        }
    }


    public function execute($sql){
        $sql_args = array_slice(func_get_args(), 1);
        try{
            $conn = $this->getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
        }
        catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }

    
}
<?php

namespace App\Models;

use Dotenv\Dotenv as Dotenv;
use PDO;
use PDOException;

class BaseModel{
    private $_host;
    private $_username;
    private $_password;
    private $_database;
    private $_charset;

    private $_pdo;

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
            $this->_pdo = new PDO($dsn, $this->_username, $this->_password);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Kết nối thành công";
        } catch (PDOException $e) {
            die("Kết nối database thất bại: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->_pdo;
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

    // Insert
    public function insert($sql){
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

    // Insert
    public function update($sql){
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


    public function query($sql){
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

    public function query_one($sql){
        $sql_args = array_slice(func_get_args(), 1);
        try{
            $conn = $this->getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }

    public function insert2($table, $data) {
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

    public function update2($table, $data, $condition) {
        try {
            $setClause = implode(', ', array_map(fn($key) => "$key = ?", array_keys($data)));

            $sql = "UPDATE $table SET $setClause WHERE $condition";
            $this->execute($sql, ...array_values($data));
        } catch (PDOException $e) {
            // Handle or log the exception
            throw $e;
        }
    }

    public function delete2($table, $condition) {
        try {
            $sql = "DELETE FROM $table WHERE $condition";
            $this->execute($sql);
        } catch (PDOException $e) {
            // Handle or log the exception
            throw $e;
        }
    }
}

//Cách sử dụng

// // Instantiate your BaseModel
// $baseModel = new BaseModel();

// // Example Insert
// $insertData = ['column1' => 'value1', 'column2' => 'value2'];
// $baseModel->insert('your_table', $insertData);

// // Example Update
// $updateData = ['column1' => 'new_value1', 'column2' => 'new_value2'];
// $condition = 'id = 1'; // Change this condition based on your requirements
// $baseModel->update('your_table', $updateData, $condition);

// // Example Delete
// $conditionToDelete = 'id = 2'; // Change this condition based on your requirements
// $baseModel->delete('your_table', $conditionToDelete);

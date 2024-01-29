<?php

namespace App\Models;

use App\Models\Interfaces\CrudInterface;
use App\Core\Database;

class BaseModel implements CrudInterface
{
    protected $table;
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $query = "SELECT * FROM {$this->table}";
        return $this->db->select($query);
    }

    public function getOne(int $id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        return $this->db->select($query, ['id' => $id]);
    }

    public function create(array $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";

        return $this->db->insert($query, $data);
    }

    public function read(int $id)
    {
        return $this->getOne($id);
    }

    public function update(int $id, array $data)
    {
        $updateString = '';
        foreach ($data as $key => $value) {
            $updateString .= "{$key} = :{$key}, ";
        }
        $updateString = rtrim($updateString, ', ');

        $query = "UPDATE {$this->table} SET {$updateString} WHERE id = :id";

        return $this->db->update($query, array_merge(['id' => $id], $data));
    }

    public function remove(int $id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";

        return $this->db->delete($query, ['id' => $id]);
    }

     //Thêm phương thức cho việc thực hiện truy vấn JOIN
    public function join($table, $condition, $columns = '*', $type = 'INNER')
    {
        $query = "SELECT {$columns} FROM {$this->table} {$type} JOIN {$table} ON {$condition}";
        return $this->db->select($query);
    }

    

}
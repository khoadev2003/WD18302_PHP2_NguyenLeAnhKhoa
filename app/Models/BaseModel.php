<?php

namespace App\Models;

use App\Models\Interfaces\CrudInterface;
use App\Core\Database;

abstract class BaseModel implements CrudInterface
{
    protected $table;
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY id DESC";
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

    public function remove(int $id): bool
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";

        return $this->db->delete($query, ['id' => $id]);
    }

    /**
     * @param $columns
     * @param $whereCondition
     * @return array|false
     */
    public function selectWithWhere(string $columns = '*', $whereCondition = null)
    {
        $whereClause = '';
        if (!empty($whereCondition)) {
            $whereClause = "WHERE {$whereCondition}";
        }

        $query = "SELECT {$columns} FROM {$this->table} {$whereClause}";
        return $this->db->select($query);
    }

    /**
     * @param $columns
     * @param $whereField
     * @param $likeValue
     * @return array|false
     */

    /**
     * @param $columns
     * @param $whereField
     * @param $likeValue
     * @return array|false
     */
    public function selectWithLike($columns, $whereField, $likeValue)
    {
        $whereClause = '';
        if (!empty($whereField) && !empty($likeValue)) {
            $whereClause = "WHERE {$whereField} LIKE '%{$likeValue}%'";
        }

        $query = "SELECT {$columns} FROM {$this->table} {$whereClause}";


        return $this->db->select($query);
    }
//
//    public function countByColumn($column, $value): int
//    {
//        $query = "SELECT COUNT(*) AS total FROM {$this->table} WHERE {$column} = :value";
//        $result = $this->db->select($query, [$column => $value]);
//
//        if ($result && isset($result[0]['total'])) {
//            return (int)$result[0]['total'];
//        }
//
//        return 0;
//    }

    

}
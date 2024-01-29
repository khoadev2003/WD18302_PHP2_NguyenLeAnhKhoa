<?php

namespace App\Models\Interfaces;

interface CrudInterface
{
    /**
     * Dùng để lấy tất cả records
     */
    public function getAll();

    /**
     * Phương thức getOne() dùng để lấy 1 record
     * @param int $id
     * @return array $record
     */
    public function getOne(int $id);

    /**
     * Phương thức create() dùng để thêm mới dữ liệu
     * @return mixed
     */
    public function create(array $data);

    /**
     * Phương thức read() dùng để đọc 1 record
     * @param int $id
     */
    public function read(int $id);

    /**
     * Phương thức update() cập nhật
     * @param int $id
     * @param array $data
     *
     */
    public function update(int $id, array $data);

    /**
     * Phương thức remove() dùng để xóa 1 record
     * @param int $id
     */
    public function remove(int $id);
}
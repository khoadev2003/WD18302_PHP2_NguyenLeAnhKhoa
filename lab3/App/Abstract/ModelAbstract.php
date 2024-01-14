<?php

namespace App\Abstract;

abstract class ModelAbstract
{
    abstract public function select($sql);

    abstract public function update($table, $data, $condition);

    abstract public function delete($table, $condition);

    abstract public function insert($table, $data);
}

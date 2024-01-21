<?php
/*
 * Kế thừa từ class core/Model
 *
 * */
use App\Core\Database;
use App\Models\BaseModel;

class HomeModel extends BaseModel {
    protected $table = 'products';

    public function getList() {
        $sql = "SELECT * FROM products";
        $list = $this->query($sql);

        return $list;
    }

    public function getProductbyId($id) {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $list = $this->query_one($sql, $id);

        return $list;
    }

    public function getDetail($id) {
        $data = [
            'Item 1',
            'Item 3',
            'Item 3'
        ];

        return $data[$id];
    }

    public function insert_product($name, $image, $status) {
        $sql = "INSERT INTO categories(name, image, status) VALUES (?,?,?)";

        return $this->insert($sql,$name, $image, $status);
    }

    public function update_cate($name, $status, $id) {
        $sql = "UPDATE categories SET 
            name = '".$name."',";


        $sql .= " status = '".$status."'
                    WHERE category_id = ".$id;

        return $this->update($sql);
    }
}
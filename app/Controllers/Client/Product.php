<?php

namespace App\Controllers\Client;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class Product extends Controller {

    public $data = [];
    public function index($id=0) {
        echo 'Danh sách sản phẩm';
        $this->data['sub_content']['title'] = "Danh sách sản phẩm";
        $home = $this->model('HomeModel');
        $this->data['content']= 'products/list';
        $this->data['sub_content']['list_product']= $home->getList();
        $this->data['sub_content']['one_product']= $home->getProductbyId($id);
        $this->render('layouts/client_layout', $this->data);
    }


    public function detail($id=0, $id_cate=0){
        $id = $_GET['id'];

        $product = $this->model('ProductModel');
        $home = $this->model('HomeModel');
        $this->data['sub_content']['title'] = '<br>Chi tiết sản phẩm <br>';
        $this->data['page_title'] = 'Chi tiết sản phẩm';
        $this->data['sub_content']['action'] = 'them-san-pham';
        $this->data['content']= 'products/detail';
        $this->data['sub_content']['id_category']= $id_cate;
        $this->data['sub_content']['list_product']= $home->getList();
        $this->data['sub_content']['one_product']= $home->getProductbyId($id);
        //Render
        $this->render('layouts/client_layout', $this->data);


    }

}
<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class AirportController extends Controller{
    public $data = [];

    public function index() {
        $_SESSION['title_page'] = 'Danh sách sân bay';

        

        $this->data['main']= 'admin/airports/list';
        $this->data['content']['title']= "Thêm vé máy bay";
        $this->render('layouts/admin_layout', $this->data);
    }


    public function add() {
        $_SESSION['title_page'] = 'Thêm sân bay';

        

        $this->data['main']= 'admin/tickets/add';
        $this->data['content']['title']= "Thêm vé máy bay";
        $this->render('layouts/admin_layout', $this->data);
    }

    public function update() {
        
    }

    public function delete() {
        $_SESSION['title_page'] = 'Danh sách vé máy bay';

        $this->data['main']= 'admin/tickets/list2';
        $this->data['content']['title']= "Thêm vé máy bay";
        $this->render('layouts/admin_layout', $this->data);
    }
}
<?php


namespace App\Controllers\Admin;

use App\Core\Controller;

class AirlineController extends Controller{
    public $data = [];


    public function index() {
        $_SESSION['title_page'] = 'Thêm vé hãng hàng không';

        

        $this->data['main']= 'admin/airline/list';
        $this->data['content']['title']= "Thêm vé máy bay";
        $this->render('layouts/admin_layout', $this->data);
    }

    public function update() {
        
    }

    public function delete() {

        $this->data['main']= 'admin/tickets/list2';
        $this->data['content']['title']= "Thêm vé máy bay";
        $this->render('layouts/admin_layout', $this->data);
    }
}
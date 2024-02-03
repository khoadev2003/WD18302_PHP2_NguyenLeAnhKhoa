<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\User;
use App\Repositories\UserRepository;

class DashboardController extends Controller{
    public $data = [];

    public function __construct()
    {
        // Check login
        UserRepository::checkLogin();
    }

    public function index() {
        $_SESSION['title_page'] = 'Quản lí vé máy bay';

        $this->data['content']['title']= "Thêm vé máy bay";
        $this->data['main']= 'admin/dashboard/index';
        $this->render('layouts/admin_layout', $this->data);
    }

    public function add() {
        $_SESSION['title_page'] = 'Thêm vé máy bay';

        $arr = [];
        if(isset($_POST['add_ticket'])) {

            $arr = [
                'departure_date' => $_POST['departure_date'],
                'arrival_date' => $_POST['arrival_date']
            ];
                    
            // dd($arr);
        }

        $this->data['content']['data']= $arr;

        $this->data['main']= 'admin/tickets/add';
        $this->data['content']['title']= "Thêm vé máy bay";
        $this->render('layouts/admin_layout', $this->data);
    }

    public function list() {
        $_SESSION['title_page'] = 'Danh sách vé máy bay';

        $this->data['main']= 'admin/tickets/list';
        $this->data['content']['title']= "Thêm vé máy bay";
        $this->render('layouts/admin_layout', $this->data);
    }

    public function list2() {
        $_SESSION['title_page'] = 'Danh sách vé máy bay';

        $this->data['main']= 'admin/tickets/list2';
        $this->data['content']['title']= "Thêm vé máy bay";
        $this->render('layouts/admin_layout', $this->data);
    }

    public function _404() {
       require_once 'app/Errors/404.php';
    }
}
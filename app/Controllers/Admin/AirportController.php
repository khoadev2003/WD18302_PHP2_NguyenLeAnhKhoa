<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Airline;

class AirportController extends Controller{
    public $data = [];

    public function index() {
        Session::set('title_page', 'Danh sách sân bay');

        $airport = new Airport();

        // View
        $this->data['main']= 'admin/airports/list';

        $this->data['content'] = [
            'title' => 'Danh sách sân bay á á',
            'list_airport' => $airport->getAll(),
        ];
        $this->render('layouts/admin_layout', $this->data);
    }




    public function addAirport() {
        Session::set('title_page', 'Thêm sân bay');


        $this->data['main']= 'admin/airports/add';
        $this->data['content']['title']= "Thêm sân bay";
        $this->render('layouts/admin_layout', $this->data);
    }

    public function checkAdd()
    {
        $request = new Request();
        $count_err = 0;

        $name_airport = $request->input('name');
        $location = $request->input('location');

        if(empty($name_airport)) {
            Session::set('err_name', 'Tên sân bay không được để trống');
            $count_err++;
        }elseif (strlen($name_airport) > 255) {
            Session::set('err_name', 'Tên sân bay tối đa 255 ký tự');
            $count_err++;
        }

        if(empty($location)) {
            Session::set('err_location', 'Địa điểm không được để trống');
            $count_err++;
        }elseif (strlen($location) > 255) {
            Session::set('err_location', 'Địa điểm tối đa 255 ký tự');
            $count_err++;
        }

        if($count_err > 0) {
            with('name', $name_airport);
            with('location', $location);

            $request->redirect('admin/them-san-bay');
        }else {
            //Xử lý thêm sân bay -> Models
            $request->redirect('admin/them-san-bay');
        }

//        dd($request->all());
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
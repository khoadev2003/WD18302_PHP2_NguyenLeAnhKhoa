<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Airline;
use App\Repositories\AirportRepository;
use App\Repositories\UserRepository;
use App\Validator\AirportValidator;

class AirportController extends Controller{
    public $airportRepository;
    public $airportValidator;
    public $request;
    public $data = [];

    public function __construct()
    {
        // Check login
        UserRepository::checkLogin();

        $this->request = new Request();
        $this->airportRepository = new AirportRepository();
        $this->airportValidator = new AirportValidator();
    }

    public function index() {
        Session::set('title_page', 'Danh sách sân bay');

        $airport = new Airport();

        // View
        $this->data['main']= 'admin/airports/list';

        $this->data['content'] = [
            'title' => 'Danh sách sân bay',
            'list_airport' => $this->airportRepository->getAllAirport(),
        ];
        $this->render('layouts/admin_layout', $this->data);
    }




    public function addAirport() {
        Session::set('title_page', 'Thêm sân bay');


        $this->data['main']= 'admin/airports/add';
        $this->data['content']['title']= "Thêm sân bay";
        $this->render('layouts/admin_layout', $this->data);
    }

    public function handleAddAirport()
    {
        $count_err = 0;

        $name_airport = $this->request->input('name');
        $location = $this->request->input('location');


        if($this->airportValidator->checkNameExists($name_airport)) {
            Session::set('err_name', 'Tên sân bay đã tồn tại');
            $count_err++;
        }

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

            $this->redirect('admin/them-san-bay');
        }else {
            //Xử lý thêm sân bay -> airportRepository
            $data = [
                'name' => $name_airport,
                'location' => $location,
            ];

            $result = $this->airportRepository->createAirport($data);

            if ($result !== false && $result !== null) {
                Session::set('success', 'Thêm sân bay thành công.');

            } else {
                Session::set('error', 'Thêm sân bay thất bại.');

            }

            $this->redirect('admin/san-bay');
        }

    }

    public function updateAirport() {
        Session::set('title_page', 'Cập nhật sân bay');

        $id_airport = $this->request->get('id');

        $this->data['main']= 'admin/airports/update';

        $this->data['content']= [
            'title' => 'Cập nhật sân bay',
            'airport_detail' => $this->airportRepository->getAirportById($id_airport),
        ];

        $this->render('layouts/admin_layout', $this->data);
    }

    public function handleUpdateAirport() {
        $id_airport = $this->request->get('id');

        $name_airport = $this->request->input('name');
        $location = $this->request->input('location');

        $count_err = $this->validateAirport($name_airport, $location);

        if ($count_err > 0) {
            with('name', $name_airport);
            with('location', $location);

            $this->redirect('admin/san-bay/cap-nhat/'.$id_airport);

        } else {
            // Handle updating airport
            $data = [
                'name' => $name_airport,
                'location' => $location,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $this->airportRepository->updateAirport($id_airport, $data);

            // Handle the result
            if($this->handleResult($result)) {
                Session::set('success', 'Cập nhật thành công');
                $this->redirect('admin/san-bay/cap-nhat/'.$id_airport);

            }else {
                Session::set('not_success', 'Cập nhật thất bại');
                $this->redirect('admin/san-bay/cap-nhat/'.$id_airport);

            }

        }

    }


    private function validateAirport($name, $location)
    {
        $count_err = 0;

        if ($this->airportValidator->checkNameExists($name)) {
            Session::set('err_name', 'Tên sân bay đã tồn tại');
            $count_err++;
        }

        if (empty($name)) {
            Session::set('err_name', 'Tên sân bay không được để trống');
            $count_err++;
        } elseif (strlen($name) > 255) {
            Session::set('err_name', 'Tên sân bay tối đa 255 ký tự');
            $count_err++;
        }

        if (empty($location)) {
            Session::set('err_location', 'Địa điểm không được để trống');
            $count_err++;
        } elseif (strlen($location) > 255) {
            Session::set('err_location', 'Địa điểm tối đa 255 ký tự');
            $count_err++;
        }

        return $count_err;
    }

    private function handleResult($result): bool
    {
        if ($result !== false && $result !== null) {
            return true;
        } else {
            return false;
        }
    }

    public function handleDeleteAirport() {
        $id_airport = $this->request->get('id');


        $result = $this->airportRepository->removeAirport($id_airport);
        if($result) {
            Session::set('success', 'Xóa sân bay thành công!');
            $this->redirect('admin/san-bay');
        }else {
            Session::set('not_success', 'Xóa sân bay thất bại!');
            $this->redirect('admin/san-bay');
        }
    }
}